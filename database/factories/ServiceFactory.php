<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        // Get only provider-type users
        $provider = User::where('type', 'provider')->inRandomOrder()->first();

        return [
            'provider_id' => $provider ? $provider->id : User::factory()->create(['type' => 'provider'])->id,
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(10),
            'duration' => $this->faker->randomFloat(2, 10, 900),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
