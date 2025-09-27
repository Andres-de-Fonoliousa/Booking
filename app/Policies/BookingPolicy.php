<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;

class BookingPolicy
{
    public function show(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id || $user->id === $booking->provider_id;
    }

    public function create(User $user, Service $service): bool
    {
        $hasRecentBooking = Booking::where('user_id', $user->id)
            ->where('service_id', $service->id)
            ->where('created_at', '>=', now()->subDay())
            ->exists();
        return !$hasRecentBooking && $user->id !== $service->provider_id;
    }

    public function update(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id || $user->id === $booking->provider_id;
    }

    public function delete(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id || $user->id === $booking->provider_id;
    }
}
