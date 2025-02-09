<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $services = Service::all();
        return view('auth.register', compact('services'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'date'],
            'lieu_naissance' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'string', 'in:homme,femme'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'date_embauche' => ['required', 'date'],
            'salaire' => ['required', 'integer'],
            'solde_conges' => ['required', 'integer'],
            'fonction_id' => ['nullable', 'integer'],
            'service_id' => ['nullable', 'integer'],
            'type' => ['required', 'string', 'in:employe,chef de service,grh,directeur'],
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'date_naissance' => $request->date_naissance,
            'lieu_naissance' => $request->lieu_naissance,
            'sexe' => $request->sexe,
            'email' => $request->email,
            'password' => Hash::make($request->password_confirmation),
            'date_embauche' => $request->date_embauche,
            'salaire' => $request->salaire,
            'solde_conges' => $request->solde_conges,
            'fonction_id' => $request->fonction_id,
            'service_id' => $request->service_id,
            'type' => $request->type,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
