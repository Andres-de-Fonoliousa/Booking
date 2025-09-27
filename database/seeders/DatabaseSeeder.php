<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->count(5)->create([
            'type' => 'provider' // Ensure your User factory supports this
        ]);

        // Then: CREATE services tied to these material providers
        \App\Models\Service::factory(10)->create();

        // Finally: CREATE the specific test service
        $provider = \App\Models\User::where('type', 'provider')->first();

        \App\Models\Service::factory()->create([
            'provider_id' => $provider->id,
            'name' => 'Premium Coastal Therapy',
            'description' => 'Luxury beachside massage with sea-glass exfoliation',
            'price' => 199.99,
            'status' => 'active',
        ]);
    }
}
