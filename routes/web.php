<?php

use App\Http\Controllers\GoodController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});






Route::get("/goods/create",[GoodController::class,'create'])->name('good.create');
Route::post("/goods/show/{good}",[GoodController::class,'show'])->name('good.show');

Route::delete("/goods",[GoodController::class,'destroy'])->name('good.destroy');

Route::get("/goods",[GoodController::class,'index'])->name('good.index');
Route::get("/goods/edit/{good}",[GoodController::class,'edit'])->name('good.edit');


require __DIR__.'/auth.php';
