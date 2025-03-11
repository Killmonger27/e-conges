<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     */


        public function run()
    {
        // Permissions
        $permissions = [
            // Demandes
            'creer_demande',
            'voir_demandes_personnelles',
            'voir_demandes_service' ,
            'donner_avis',
            'decision_finale',
            
            // Gestion
            'gerer_employes' ,
            'voir_employes',
            'gerer_services' ,
            'gerer_fonctions'
        ];

        // Création des permissions
        foreach ($permissions as $name) {
            Permission::create(['name' => $name]);
        }

        // Structure des rôles et leurs permissions
        $roleStructure = [
            'employe' => [
                'creer_demande',
                'voir_demandes_personnelles'
            ],
            'chef de service' => [
                'creer_demande',
                'voir_demandes_personnelles',
                'voir_demandes_service',
                'donner_avis',
                'voir_employes'
            ],
            'grh' => [
                'creer_demande',
                'voir_demandes_personnelles',
                'voir_demandes_service',
                'donner_avis',
                'gerer_employes',
                'gerer_fonctions',
                'gerer_services'
            ]
        ];

        // Création des rôles avec leurs permissions
        foreach ($roleStructure as $role => $permissions) {
            $role = Role::create(['name' => $role]);
            $role->givePermissionTo($permissions);
        }
    }
}


