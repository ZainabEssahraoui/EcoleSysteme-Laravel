<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Group;
use App\Models\Grade;
use App\Models\User;
use App\Models\Module;
use App\Models\Course;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer des utilisateurs personnalisés
        $groups = Group::factory(3)->create();

        // 2️⃣ Créer des modules
        $modules = Module::factory(5)->create();

        // 3️⃣ Créer des utilisateurs (profs et étudiants)
        $users = User::factory(10)->create();

        // 4️⃣ Créer des cours
        Course::factory(10)->create();

        // 5️⃣ Créer des notes
        Grade::factory(20)->create();
       $this->call(GroupSeeder::class);
       $this->call(ModuleSeeder::class);
        $this->call(UserSeeder::class);

    }
}
