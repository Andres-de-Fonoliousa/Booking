<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;
use App\Models\Service;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function () {
    Route::get('/test', [BookingController::class, 'edit'])->name('test');

    Route::get('/home', function () {
        return Inertia::render('dashboard', [
            'services' => Service::with('provider')->get()
        ]);
    })->name('home');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [Authcontroller::class, 'login'])->name('login');
    Route::get('/', function () {
        return Inertia::render('Welcome');
    });
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('services/index', [ServiceController::class, 'index'])->name('services.index');
    Route::get('services/show/{service}', [ServiceController::class, 'show'])->name('services.show');
    Route::get('services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('services/store', [ServiceController::class, 'store'])->name('services.store')->middleware('throttle:global');
    Route::get('services/edit/{service}', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('services/{service}/update', [ServiceController::class, 'update'])->name('services.update')->middleware('throttle:global');
    Route::delete('services/{service}/delete', [ServiceController::class, 'delete'])->name('services.delete');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('bookings/index', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/show/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('bookings/create/{service}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('bookings/store', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('bookings/{booking}/update', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('bookings/{booking}/delete', [BookingController::class, 'delete'])->name('bookings.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'show'])->name('dashboard');
});
