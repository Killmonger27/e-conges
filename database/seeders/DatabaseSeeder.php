<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\PermissionsSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            PermissionsSeeder::class,
        ]);

        User::create([
            'nom' => 'Ouarma',
            'prenom' => 'Landry',
            'adresse' => '12 rue de la gare',
            'telephone' => '07399750',
            'date_naissance' => '1995-01-01',
            'lieu_naissance' => 'Paris',
            'sexe' => 'homme',
            'email' => 'landryouarma45@gmail.com',
            'password' => bcrypt('12345678'),
            'date_embauche' => '2020-01-01',
            'salaire' => 100000,
            'solde_conges' => 10,
            'fonction_id' => null,
            'service_id' => null,
            'type' => 'grh',
        ]);
    }
}
