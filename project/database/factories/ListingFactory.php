<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'tags' => 'electronic, home appliances, foods & beverages',
            'company' => $this->faker->company(),
            'email' => $this->faker->companyEmail(),
            'location' => $this->faker->city(),
            'website' => $this->faker->url(),
            'oldPrice' => $this->faker->randomFloat(2, 10, 100), // Generate random oldPrice between 10 and 100
            'newPrice' => $this->faker->randomFloat(2, 5, 90),   // Generate random newPrice between 5 and 90
            'description' => $this->faker->paragraph(5),
        ];
    }
}
