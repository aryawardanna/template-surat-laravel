<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Letter;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Letter>
 */
class LetterFactory extends Factory
{
	protected $model = Letter::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
			'description' => $this->faker->paragraph(2, true),
			'typeletter' => $this->faker->randomElement(['formal', 'nonformal']),
			'file' => $this->faker->url(),
			'cover' => $this->faker->url(),
			'category_id' => Category::inRandomOrder()->first()->id,
			'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
