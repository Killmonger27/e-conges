<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Demande;
use App\Models\Service;
use App\Models\Fonction;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Notifications\DemandeSoumiseNotification;
use App\Notifications\DemandeTraiteeNotification;
use Illuminate\Support\Facades\Notification;

class DashboardController extends Controller{
    public function index()
    {
        $user = Auth::user();



        $service = $user->service_id;

        $demandes = Demande::with('employe', 'service')->paginate(10);

        $mesdemandes = Demande::where('employe_id', $user->id)
            ->with('employe', 'service');
        
        
        $mesdemandesvalidees = Demande::where('employe_id', $user->id)
            ->where('status', 'accorde');

        $mesdemandesrejetees = Demande::where('employe_id', $user->id)
            ->where('status', 'rejete')
            ->with('employe','service');;
        
        $mesdemandesencours = Demande::where('employe_id', $user->id)
            ->where('status', 'encours')
            ->where('action', 'envoyer');

        $mesdemandesbrouillons = Demande::where('employe_id', $user->id)
            ->where('action', 'planifier')
            ->with('employe','service');
        $soldeConges = $user->solde_conges;

        

        if ($user->type === 'employe'){
            return view('dashboard',compact('mesdemandes', 'mesdemandesvalidees', 'mesdemandesrejetees', 'mesdemandesencours', 'soldeConges', 'mesdemandesbrouillons'));
        } 

        $touteslesdemandes = Demande::where('action', 'envoyer');

        $enCours = Demande::where('status', 'encours')->where('action', 'envoyer');
        $validees = Demande::where('status', 'accorde');
        $rejetees = Demande::where('status', 'rejete');

        $totalFonctions = Fonction::count();
        $dernieresFonctions = Fonction::orderBy('id', 'desc')->take(3)->get();

        $totalServices = Service::count();
        $derniersServices = Service::orderBy('id', 'desc')->take(3)->get();

        $totalUtilisateurs = User::count();
        $derniersUtilisateurs = User::orderBy('id', 'desc')->take(3)->get();

        
        if($user->type ==='grh' || $user->type === 'chef de service'){
            return view('dashboard',compact('touteslesdemandes',
            'enCours', 
            'validees', 
            'rejetees',
            'mesdemandes', 
            'mesdemandesvalidees', 
            'mesdemandesrejetees', 
            'mesdemandesencours', 
            'mesdemandesbrouillons',
            'totalFonctions',
            'dernieresFonctions',
            'totalServices',
            'derniersServices',
            'totalUtilisateurs',
            'derniersUtilisateurs',
        ));
        }

    }
}