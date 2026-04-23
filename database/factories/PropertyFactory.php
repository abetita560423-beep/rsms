<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = Property::TYPES;
        $categories = Property::CATEGORIES;

        return [
            'user_id' => User::where('role', User::ROLE_SELLER)->inRandomOrder()->first()?->id ?? User::factory()->seller(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->numberBetween(1500000, 50000000),
            'type' => $this->faker->randomElement($types),
            'category' => $this->faker->randomElement($categories),
            'location' => $this->faker->city() . ', ' . $this->faker->state(),
            'bedrooms' => $this->faker->numberBetween(1, 6),
            'bathrooms' => $this->faker->numberBetween(1, 5),
            'sqft' => $this->faker->numberBetween(50, 500),
            'status' => Property::STATUS_APPROVED,
            'image' => null, // We'll use the Unsplash fallbacks in the UI
        ];
    }
}
