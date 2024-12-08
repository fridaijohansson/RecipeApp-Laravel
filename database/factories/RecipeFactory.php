<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence,
            'image' => null,
            'slug' => fake()->slug(),
            'description' => fake()->paragraph(10),
            'ingredients' => $this->generateIngredientsList(),
            'instructions' => $this->generateInstructionsList(),
        ];
    }

    private function generateIngredientsList()
    {
        $ingredients = [];
        for ($i = 0; $i < 7; $i++) {
            $amount = $this->faker->randomDigitNotZero();
            $measurement = $this->faker->randomElement(['cup', 'tablespoon', 'teaspoon', 'gram', 'ounce']);
            $ingredient = $this->faker->word;
            $ingredients[] = "$amount $measurement $ingredient";
        }
        return $ingredients;
    }
    private function generateInstructionsList()
    {
        // Generate a fake instructions list in plain text format
        $instructions = [];
        for ($i = 0; $i <= 5; $i++) {
            $instruction = $this->faker->paragraph();
            $instructions[] = "$instruction";
        }
        return $instructions; 
    }
}
