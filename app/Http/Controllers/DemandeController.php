<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Demande;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Notifications\DemandeSoumiseNotification;
use App\Notifications\DemandeTraiteeNotification;
use Illuminate\Support\Facades\Notification;

class DemandeController extends Controller
{
    public function index()
    {
        $service = Auth::user()->service_id;

        $demandes = Demande::with('employe', 'service')->get();
        
        $mesdemandes = Demande::where('employe_id', Auth::user()->id)
            ->with('employe', 'service')
            ->paginate(10);

        $demandesService = Demande::where('service_id', $service)
            ->where('employe_id', '!=', Auth::user()->id)
            ->with('employe', 'service')
            ->paginate(10);

        $user = Auth::user();

        return view('demandes.index', compact('demandes', 'user', 'mesdemandes', 'demandesService'));
    }

    public function mesDemandes(){
        $user = Auth::user();
        $mesdemandes = Demande::where('employe_id', $user->id)
            ->where('action', 'envoyer')
            ->with('employe', 'service')
            ->paginate(10);

        return view('demandes.mesdemandes.index', compact('mesdemandes', 'user'));
    }

    public function showMesDemandes(int $id)
    {   
        $demande = Demande::find($id);

        return view('demandes.mesdemandes.show', compact('demande'));
    }

    public function create()
    {
        return view('demandes.mesdemandes.create');


    }


    public function grhEdit(int $id)
    {
        $demande = Demande::find($id);
        // Vérifier si l'utilisateur est un GRH
        if (Auth::user()->type!== 'grh') {
            abort(403, 'Vous n\'avez pas l\'autorisation d\'accéder à cette page.');
        }
        // Vérifier si la demande est en cours
        if ($demande->status!== 'encours') {
            return redirect()->back()->with('error', 'Vous ne pouvez éditer que les demandes en cours.');
        }

        return view('demandes.grh.edit', compact('demande'));
    }

    public function grhUpdate(Request $request, int $id)
    {
        $demande = Demande::find($id);
        // Vérifier si l'utilisateur est un GRH
        if (Auth::user()->type!== 'grh') {
            abort(403, 'Vous n\'avez pas l\'autorisation d\'effectuer cette action.');
        }
        // Vérifier si la demande est en cours
        if ($demande->status!== 'encours') {
            return redirect()->back()->with('error', 'Vous ne pouvez éditer que les demandes en cours.');
        }

        $validatedData = $request->validate([
            'type_de_demande' => 'required|string',
            'motif' => 'required|string',
            'date_de_debut' => 'required|date',
            'date_de_fin' => 'required|date|after_or_equal:date_de_debut',
        ]);

        $demande->update($validatedData);

        return redirect()->route('demandes.show', $demande->id)->with('success', 'La demande a été mise à jour avec succès.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'motif' => 'required|string',
            'type_de_demande' => 'required|string|in:conge,absence',
            'date_de_debut' => 'required|date',
            'date_de_fin' => 'required|date|after_or_equal:date_de_debut',
            'action' => 'required|string|in:planifier,envoyer',
        ]);

        $demande = Demande::create([
            'motif' => $request->motif,
            'type_de_demande' => $request->type_de_demande,
            'date_de_debut' => $request->date_de_debut,
            'date_de_fin' => $request->date_de_fin,
            'action' => $request->action,
            'employe_id' => Auth::id(),
            'service_id' => Auth::user()->service_id,
            'date_de_demande' => now()->toDateString(),
            'status' => Demande::STATUS_ENCOURS,
        ]);

        // if ($demande->action == "envoyer"){
        //     $user = Auth::user();

        //     $service = $user->service;

        //     // Récupérer le chef de service
        //     if ($service && $service->chefService) {
        //         $chefDeService = $service->chefService;
        //         // $chefDeService est maintenant l'utilisateur qui est le chef de service
        //         try {
        //             Notification::route('mail', $chefDeService->email)
        //                 ->notify(new DemandeSoumiseNotification($demande));
        //         }
        //         catch (\Exception $e) {
        //             // Gérer le cas où l'utilisateur n'est pas connecté
        //             throw new \Exception("L'utilisateur n'est pas connecté.");
        //         }
        //     } else {
        //         // Gérer le cas où il n'y a pas de service ou de chef de service
        //         throw new \Exception("Aucun chef de service trouvé pour cet utilisateur.");
        //     }
            

        //     $grh = User::where('type', 'grh')->get();

        //     foreach ($grh as $user){
        //         Notification::route('mail', $user->email)
        //             ->notify(new DemandeSoumiseNotification($demande));
        //     }
        // }

        return redirect()->route('mesdemandes.index')->with('message', 'La demande a été créée avec succès');
    }

    public function show(int $id)
    {   
        $demande = Demande::find($id);
        $employe = User::find($demande->employe_id);
        $service = Service::find($demande->service_id);

        return view('demandes.show', compact('demande'));
    }

    public function approve(Demande $demande)
    {

            if ($demande->isEnCours()) {
                $demande->status = Demande::STATUS_ACCORDE;
                $demande->save();
                // Calculer la durée de la demande
                $dateDebut = \Carbon\Carbon::parse($demande->date_de_debut);
                $dateFin = \Carbon\Carbon::parse($demande->date_de_fin);
                
                // Calculer la durée en jours
                // prend la date de fin moins la date de debut

                $duree = $dateDebut->diffInDays($dateFin);
                
                $user = User::find($demande->employe_id);
                $user->solde_conges -= $duree;
                $user->save();

                // Notification::route('mail', $demande->employe->email)
                // ->notify(new DemandeTraiteeNotification($demande, 'approuvee'));

                return redirect()->route('demandes.index')->with('message', 'La demande a été approuvée avec succès');
            }
            return redirect()->route('demandes.index')->with('error', 'La demande ne peut pas être approuvée car elle n\'est pas en cours');
    }

    public function reject(Demande $demande)
    {
            if ($demande->isEnCours()) {
                $demande->status = Demande::STATUS_REJETE;
                // Notification::route('mail', $demande->employe->email)
                // ->notify(new DemandeTraiteeNotification($demande, 'rejetee'));
                $demande->save();
                return redirect()->route('demandes.index')->with('message', 'La demande a été rejetée avec succès');
            }
        
    }

    // Afficher les demandes au brouillon de l'utilisateur
    public function brouillons()
    {
        $user = Auth::user();
        $brouillons = Demande::where('employe_id', $user->id)
            ->where('action', Demande::ACTION_PLANIFIER)
            ->get();

        return view('demandes.brouillons.index', compact('brouillons'));
    }

    // Afficher le formulaire d'édition d'une demande au brouillon
    public function editBrouillon(Demande $demande)
    {
        if ($demande->employe_id!== Auth::user()->id ||!$demande->isBrouillon()) {
            abort(403, 'Vous n\'avez pas l\'autorisation d\'éditer cette demande.');
        }

        return view('demandes.brouillons.edit', compact('demande'));
    }

    // Mettre à jour une demande au brouillon
    public function updateBrouillon(Request $request, Demande $demande)
    {
        $validatedData = $request->validate([
            'type_de_demande' => 'required|string',
            'motif' => 'required|string',
            'date_de_debut' => 'required|date',
            'date_de_fin' => 'required|date|after_or_equal:date_de_debut',
        ]);

        $demande->update($validatedData);

        return redirect()->route('demandes.show_brouillon', $demande)->with('success', 'La demande a été mise à jour avec succès.');
    }

    // Envoyer une demande au brouillon
    public function sendBrouillon(Demande $demande)
    {
        if ($demande->employe_id!== Auth::user()->id ||!$demande->isBrouillon()) {
            abort(403, 'Vous n\'avez pas l\'autorisation d\'envoyer cette demande.');
        }

        $demande->action = Demande::ACTION_ENVOYER;
        $demande->status = Demande::STATUS_ENCOURS;
        $demande->save();

        return redirect()->route('demandes.brouillons')->with('success', 'La demande a été envoyée avec succès.');
    }


    public function showBrouillon(Demande $demande)
    {
        if ($demande->employe_id!== Auth::user()->id ||!$demande->isBrouillon()) {
            abort(403, 'Vous n\'avez pas l\'autorisation d\'accéder à cette demande.');
        }

        return view('demandes.brouillons.show', compact('demande'));
    }

    public function destroyBrouillon(Demande $demande)
    {
        if ($demande->employe_id!== Auth::user()->id ||!$demande->isBrouillon()) {
            abort(403, 'Vous n\'avez pas l\'autorisation de supprimer cette demande.');
        }

        $demande->delete();

        return redirect()->route('demandes.brouillons')->with('success', 'La demande au brouillon a été supprimée avec succès.');
    }
}

    
