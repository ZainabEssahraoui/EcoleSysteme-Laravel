<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Grade;
use App\Models\User;
use App\Models\Module;

class GradeFactory extends Factory
{
    protected $model = Grade::class;

    public function definition()
    {
        return [
            'student_id' => User::factory()->state(['role' => 'student']),
            'prof_id' => User::factory()->state(['role' => 'prof']),
            'module_id' => Module::factory(),
            'grade' => $this->faker->randomFloat(2, 0, 20),
        ];
    }
}
