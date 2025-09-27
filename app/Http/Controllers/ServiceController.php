<?php

namespace App\Http\Controllers;

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
use App\Http\Requests\StoreServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the services.
     */
    public function index(): Response
    {
        try {
            $services = Service::with('provider')->get();
            return Inertia::render('services/index', ['services' => $services]);
        } catch (\Exception $e) {
            return Inertia::render('services/error', [
                'message' => 'Could not retrieve services: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        try {
            return Inertia::render('services/create', [
                'user_id' => auth()->user()->id,
            ]);
        } catch (\Exception $e) {
            return Inertia::render('services/error', [
                'message' => 'Could not create sevice ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        try {

            Service::create($request->validated());
            return redirect()->route('services.index')->with('alert', 'Service created successfully!');
        } catch (\Exception $e) {
            return Inertia::render('services/error', [
                'message' => 'Could not create the service: ' . $e->getMessage()
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        try {
            $service->load('provider', 'bookings');
            return Inertia::render('services/show', [
                'service' => $service
            ]);
        } catch (\Exception $e) {
            return Inertia::render('services/error', [
                'message' => 'Could not show the service: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $this->authorize('edit', $service);
        try {
            if (auth()->user()->id == $service->provider_id) {
                return Inertia::render('services/edit', ['service' => $service, 'user_id' => auth()->user()->id]);
            } else {
                return back()->with(['message' => "You can't edit this service!"]);
            }
        } catch (\Exception $e) {
            return Inertia::render('services/error', [
                'message' => 'failed to edit the service, try again later!' . $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreServiceRequest $request, Service $service)
    {
        $this->authorize('update', $service);
        try {
            $service->update($request->validated());
            return redirect()->route('services.index')->with('success', 'Service updated successfully!');
        } catch (\Exception $e) {
            return Inertia::render('services/error', [
                'message' => 'could not update the service!' . $e->getMessage()
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);
        try {
            $service->delete();
            return redirect('services/show', with(['message' => 'service deleted succefully']));
        } catch (\Exception $e) {
            return redirect('services/error', ['message' => 'could not delete the service'] . $e->getMessage());
        }
    }
}
