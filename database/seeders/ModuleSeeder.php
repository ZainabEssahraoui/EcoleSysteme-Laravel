<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            ['name' => 'Mathématiques'],
            ['name' => 'Physique'],
            ['name' => 'Informatique'],
            ['name' => 'Chimie'],
            ['name' => 'Biologie'],
        ];


        foreach ($modules as $module) {
            Module::create($module);
        }
    }
}
