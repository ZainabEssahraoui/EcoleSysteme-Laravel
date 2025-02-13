<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Group;
class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            ['name' => 'Groupe 1'],
            ['name' => 'Groupe 2'],
            ['name' => 'Groupe 3'],
            ['name' => 'Groupe 4'],
            ['name' => 'Groupe 5'],
        ];

        // Insérer les groupes dans la base de données
        foreach ($groups as $group) {
            Group::create($group);
        }
    }
}
