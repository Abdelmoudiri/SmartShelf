<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'prix' => $this->faker->randomFloat(2, 0, 1000),
            'quantite' => $this->faker->randomNumber(2),
            'rayon_id' => $this->faker->randomNumber(1),
        ];
    }
}
