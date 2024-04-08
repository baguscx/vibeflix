<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\MovieController;
use App\Http\Controllers\User\SubscriptionPlanController;
use App\Http\Controllers\Admin\MovieController As AdminMovieController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', '/login');

// Route::get('/dashboard', function () {
//     return Inertia::render('User/Dashboard/Index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.dashboard.')->group(function () {
        Route::put('/movie/{movie}/restore', [AdminMovieController::class, 'restore'])->name('movie.restore');
        Route::resource('movie', AdminMovieController::class);
});
Route::middleware(['auth', 'role:user'])->prefix('dashboard')->name('user.dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/movie/{movie:slug}', [MovieController::class, 'show'])->name('movie.show')->middleware('checkUserSubscription:true');
    Route::get('/subsciption-plan', [SubscriptionPlanController::class, 'index'])->name('subscriptionPlan.index')->middleware('checkUserSubscription:false');
    Route::post('/subsciption-plan/{subscriptionPlan}/user-subscribe', [SubscriptionPlanController::class, 'userSubscribe'])->name('subscriptionPlan.userSubscribe')->middleware('checkUserSubscription:false');
});

// Route::prefix('prototype')->name('prototype.')->group(function () {
//     Route::get('/login', function(){
//         return Inertia::render('Prototype/Login');
//     })->name('login');

//     Route::get('/register', function(){
//         return inertia::render('Prototype/Register');
//     })->name('register');

//     Route::get('/dashboard', function(){
//         return Inertia::render('Prototype/Dashboard');
//     })->name('dashboard');

//     Route::get('/subsciptionPlan', function(){
//         return Inertia::render('Prototype/SubscriptionPlan');
//     })->name('subscriptionPlan');

//     Route::get('/movie/{slug}', function(){
//         return Inertia::render('Prototype/Movie/Show');
//     })->name('movie.show');
// });
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
