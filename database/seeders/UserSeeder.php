<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Group; 

class UserSeeder extends Seeder
{
    /**
     * Exécute le seeder.
     *
     * @return void
     */
    public function run()
    {
    

        // Créer des utilisateurs personnalisés
        $users = [
            [
                'name' => 'Professeur Ahmed',
                'email' => 'ahmed@example.com',
                'password' => Hash::make('password123'), // Mot de passe crypté
                'CIN' => 'AB123456',
                'phone' => '0612345678',
                'adresse' => '123 Rue des Professeurs, Casablanca',
                'image' => 'profiles/ahmed.jpg',
                'role' => 'prof',
                'group_id' => 1, 
            ],
            [
                'name' => 'Étudiant Youssef',
                'email' => 'youssef@example.com',
                'password' => Hash::make('password123'),
                'CIN' => 'CD789012',
                'phone' => '0623456789',
                'adresse' => '456 Rue des Étudiants, Rabat',
                'image' => 'profiles/youssef.jpg',
                'role' => 'student',
                'group_id' => 1, // Associer cet étudiant à un groupe spécifique
            ],
            [
                'name' => 'Étudiante Fatima',
                'email' => 'fatima@example.com',
                'password' => Hash::make('password123'),
                'CIN' => 'EF345678',
                'phone' => '0634567890',
                'adresse' => '789 Rue des Étudiantes, Marrakech',
                'image' => 'profiles/fatima.jpg',
                'role' => 'student',
                'group_id' => 2, // Associer cette étudiante à un autre groupe
            ],
        ];

        // Insérer les utilisateurs dans la base de données
        foreach ($users as $user) {
            User::create($user);
        }

        // Message de confirmation
        $this->command->info('Users table seeded successfully!');
    }
}
