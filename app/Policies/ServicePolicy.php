<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;
use App\Models\Booking;

class ServicePolicy
{
    public function update(User $user, Service $service): bool
    {
        return $user->id === $service->provider_id;
    }

    public function create(User $user, Service $service): bool
    {
        return $user->id !== $service->provider_id;
    }

    public function book(User $user, Service $service)
    {
        // Check if user is not the provider
        if ($user->id === $service->provider_id) {
            return false;
        }

        // Check if user has no recent bookings for this service
        $hasRecentBooking = Booking::where('user_id', $user->id)
            ->where('service_id', $service->id)
            ->where('created_at', '>=', now()->subHours(24))
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        return !$hasRecentBooking;
    }

    public function delete(User $user, Service $service): bool
    {
        return $user->id === $service->provider_id;
    }
}
