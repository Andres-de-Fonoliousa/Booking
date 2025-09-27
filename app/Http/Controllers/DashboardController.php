<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Booking;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function show()
    {
        try {
            $type = User::where('id', auth()->user()->id)->value('type');
            $active_bookings = Booking::where('status', 'confirmed')->where('user_id', auth()->user()->id)->paginate(3);
            $pending_bookings = Booking::where('status', 'pending')->where('user_id', auth()->user()->id)->paginate(3);
            $active_bookings->load('service', 'provider');
            $pending_bookings->load('service', 'provider');
            if ($type === 'Client') {
                return Inertia::render('dashboards/client', ['active_bookings' => $active_bookings, 'pending_bookings' => $pending_bookings]);
            } elseif ($type == 'Provider') {
                return Inertia::render('dashboards/provider');
            }
        } catch (\Exception $e) {
            return Inertia::render('services/error', ['message' => 'could not retrieve dashboard!' . $e->getMessage()]);
        }
    }
}
