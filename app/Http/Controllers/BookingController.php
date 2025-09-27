<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Validation\ValidationException;
use Inertia\Response;
use App\Http\Requests\StoreBookingRequest;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $myBookings = Booking::where('user_id', auth()->user()->id)->get();
            $bookings = Booking::where('provider_id', auth()->user()->id)->get();
            $money_paid = Booking::where('status', 'confirmed')->where('user_id', auth()->id())->with('service')->get();
            $paid = $money_paid->sum(function ($booking) {
                return $booking->service->price;
            });
            $paid = number_format($paid, 2, '.', '');
            $money_pending = Booking::where('status', 'pending')->where('user_id', auth()->id())->with('service')->get();
            $pending_money = $money_pending->sum(function ($booking) {
                return $booking->service->price;
            });
            $pending_money = number_format($pending_money, 2, '.', '');
            $myPendigBookings = Booking::where('user_id', auth()->user()->id)->where('status', 'pending')->get();
            $myBookings->load('provider', 'service', 'client');
            $bookings->load('provider', 'service', 'client');
            return Inertia::render('bookings/index', ['myBookings' => $myBookings, 'bookings' => $bookings, 'money_paid' => $paid, 'myPendingBookings' => $myPendigBookings, 'pending_money' => $pending_money]);
        } catch (\Exception $e) {
            return Inertia::render('services/error', [
                'message' => 'Could not retrieve bookings: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Service $service)
    {
        $this->authorize('book', $service);
        try {
            $service->load('provider');
            return Inertia::render('bookings/create', [
                'user_id' => auth()->user()->id,
                'service' => $service,
            ]);
        } catch (\Exception $e) {
            return Inertia::render('services/error', [
                'message' => 'Could not create booking ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        try {
            if ($request->user_id != auth()->id()) {
                abort(403, 'Cannot book for other users.');
            }
            $recentBooking = Booking::where('user_id', auth()->id())
                ->where('service_id', $request->service_id)
                ->first();

            if ($recentBooking) {
                return back()->withErrors([
                    'service_id' => 'You can only book this service once.'
                ]);
            }
            Booking::create($request->validated());
            return redirect()->route('bookings.index')->with('alert', 'Booking created successfully!');
        } catch (\Exception $e) {
            return Inertia::render('services/error', [
                'message' => 'Could not create the booking: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $this->authorize('show', $booking);
        try {
            $booking->load('service', 'provider', 'client');
            return Inertia::render('bookings/show', [
                'booking' => $booking,
            ]);
        } catch (\Exception $e) {
            return Inertia::render('services/error', [
                'message' => 'could not show the service right now try again later' . $e->getMessage(),
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        if ($request->user_id != auth()->id()) {
            abort(403, 'Cannot book for other users.');
        }
        $this->auhtorize('update', $booking);
        try {
            $validated = $request->validate([
                'status' => 'required|string|in:cacelled,confirmed,pending,completed',
            ]);
            $booking->update($validated);
            return redirect()->route('bookings.index')->with('success', 'Service created successfully!');
        } catch (\Exception $e) {
            return Inertia::render('services/error', [
                'message' => 'could not update the booking!' . $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);
        try {
            Service::destroy($booking, 'user_id', 'service_id');
            return redirect('services/show', with(['message' => 'service deleted succefully']));
        } catch (\Exception $e) {
            return redirect('services/error', ['message' => 'could not delete the booking'] . $e->getMessage());
        }
    }
}
