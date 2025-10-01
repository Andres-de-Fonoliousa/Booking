<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Booking;
use App\Models\Service;

class StoreBookingRequest extends FormRequest
{

    public function authorize(): bool
    {
        $service = Service::find($this->service_id);
        return $service &&
            $this->user()->id !== $service->provider_id &&
            !$this->hasRecentBookingForService($this->user()->id, $this->service_id);
    }

    public function rules(): array
    {
        return [
            'booking_time' => [
                'required',
                'date',
                'after:now',
                function ($attribute, $value, $fail) {
                    if ($this->hasBookingConflict($this->provider_id, $value)) {
                        $fail('The provider is already booked at this time.');
                    }
                }
            ],
            'user_id' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    if ($value != $this->user()->id) {
                        $fail('You can only create bookings for yourself.');
                    }
                }
            ],
            'status' => 'required|string|in:pending,confirmed,cancelled,completed',
            'provider_id' => 'required|exists:users,id',
            'service_id' => [
                'required',
                'exists:services,id',
                function ($attribute, $value, $fail) {
                    if ($this->hasRecentBookingForService($this->user()->id, $value)) {
                        $fail('You already have a recent booking for this service.');
                    }

                    $service = Service::find($value);
                    if ($service && $service->provider_id != $this->provider_id) {
                        $fail('The service does not belong to the specified provider.');
                    }
                },
            ],
        ];
    }

    protected function hasRecentBookingForService($userId, $serviceId): bool
    {
        return Booking::where('user_id', $userId)
            ->where('service_id', $serviceId)
            ->where('created_at', '>=', now()->subHours(24))
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();
    }

    /**
     * Check if a provider has a booking conflict at a specific time
     */
    protected function hasBookingConflict($providerId, $bookingTime): bool
    {
        return Booking::where('provider_id', $providerId)
            ->where('booking_time', $bookingTime)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();
    }

    public function messages(): array
    {
        return [
            'booking_time.after' => 'Booking time must be in the future.',
            'status.in' => 'Status must be one of: pending, confirmed, cancelled, or completed.',
            'authorized' => 'You are not authorized to create this booking.',
        ];
    }

    protected function failedAuthorization()
    {
        throw new \Illuminate\Auth\Access\AuthorizationException(
            $this->messages()['authorized']
        );
    }
}
