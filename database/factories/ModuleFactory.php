<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Module;

class ModuleFactory extends Factory
{
    protected $model = Module::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word . ' Module',
        ];
    }
}
