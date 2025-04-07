<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use App\Models\Fonction;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EmployeCreeNotification;

class UserController extends Controller
{
    /**
     * Afficher la liste de tous les utilisateurs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employes = User::all();
        return view('employes.index', compact('employes'));
    }

    public function edit($id)
    {
        $employe = User::find($id);
        $fonctions = Fonction::all();
        $services = Service::all();
        return view('employes.edit', compact('employe', 'fonctions', 'services'));
    }

    public function create(){
        $fonctions = Fonction::all();
        $services = Service::all();
        return view('employes.create', compact('fonctions', 'services'));
    }

    /**
     * Créer un nouvel utilisateur.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = User::createUser($request->all());

            // Notification::route('mail', $user->email)
            // ->notify(new EmployeCreeNotification($user));

            return redirect()->route('employes.index')->with('message', 'Utilisateur créé avec succès');
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Afficher un utilisateur spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employe = User::find($id);
        
        return view('employes.show', compact('employe'));
    }

    /**
     * Mettre à jour un utilisateur spécifique.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }
        try {
            $user->updateUser($request->all());
            return redirect()->route('employes.show', $user->id);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Supprimer un utilisateur spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }
        $user->delete();
        return redirect()->route('employes.index')->with('message', 'Utilisateur supprimé avec succès');
    }
}
