<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('prototype')->name('prototype.')->group(function () {
    Route::get('/login', function(){
        return Inertia::render('Prototype/Login');
    })->name('login');

    Route::get('/register', function(){
        return inertia::render('Prototype/Register');
    })->name('register');

    Route::get('/dashboard', function(){
        return Inertia::render('Prototype/Dashboard');
    })->name('dashboard');

    Route::get('/subsciptionPlan', function(){
        return Inertia::render('Prototype/SubscriptionPlan');
    })->name('subscriptionPlan');

    Route::get('/movie/{slug}', function(){
        return Inertia::render('Prototype/Movie/Show');
    })->name('movie.show');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
