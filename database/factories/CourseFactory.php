<?php
namespace Database\Factories;

use App\Models\Course;
use App\Models\Module;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'module_id' => Module::factory(), // Génère un module
            'student_id' => User::factory(), // Génère un étudiant
            'file_path' => $this->faker->url(), // À mettre à jour si nécessaire
        ];
    }
}
