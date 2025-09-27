<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 random services
        Service::factory(10)->create();

        // Create one specific test service
        Service::factory()->create([
            'provider_id' => 12345, // Example ID
            'name' => 'Premium Coastal Therapy',
            'duration' => '900',
            'description' => 'Luxury beachside massage with sea-glass exfoliation',
            'price' => 199.99,
            'status' => 'active',
        ]);
    }
}
