<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category; // Ensure this is imported

class CategoryFactory extends Factory
{
    protected $model = Category::class; // Ensure this line is present

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
