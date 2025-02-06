<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Date d'embauche -->
        <div>
            <x-input-label for="date_embauche" :value="__('Date d\'embauche')" />
            <input id="date_embauche" class="block mt-1 w-full" type="date" name="date_embauche" :value="old('date_embauche')" required autofocus autocomplete="date_embauche" />
            <x-input-error :messages="$errors->get('date_embauche')" class="mt-2" />
        </div>

        <!-- Salaire -->
        <div>
            <x-input-label for="salaire" :value="__('Salaire')" />
            <x-text-input id="salaire" class="block mt-1 w-full" type="text" name="salaire" :value="old('salaire')" required autofocus autocomplete="date_embauche" />
            <x-input-error :messages="$errors->get('salaire')" class="mt-2" />
        </div>

        <!-- Solde congé -->
        <div>
            <x-input-label for="solde_conges" :value="__('Solde congé')" />
            <x-text-input id="solde_conges" class="block mt-1 w-full" type="text" name="solde_conges" :value="old('solde_conges')" required autofocus autocomplete="solde_conges" />
            <x-input-error :messages="$errors->get('solde_conges')" class="mt-2" />
        </div>

        <!--Fonction -->
        <div>
            <x-input-label for="fonction_id" :value="__('Fonction')" />
            <x-text-input id="fonction_id" class="block mt-1 w-full" type="text" name="fonction_id" :value="old('fonction_id')" required autofocus autocomplete="fonction_id" />
            <x-input-error :messages="$errors->get('fonction_id')" class="mt-2" />
        </div>

        <!-- Service -->
        <div>
            <x-input-label for="service_id" :value="__('Service')" />
            <x-text-input id="service_id" class="block mt-1 w-full" type="text" name="service_id" :value="old('service_id')" required autofocus autocomplete="service_id" />
            <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
        </div>

        <!-- Role -->
        <div>
            <x-input-label for="type" :value="__('Role')" />
            <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type')" required autofocus autocomplete="type" />
            <x-input-error :messages="$errors->get('type')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
