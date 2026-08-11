<?php

use App\Http\Controllers\KotaJailController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KotaJailController::class, 'home'])->name('home');
Route::get('/about', [KotaJailController::class, 'about'])->name('about');

Route::get('/start-tour', [KotaJailController::class, 'startTour'])->name('tour.start');
Route::get('/tour-map', [KotaJailController::class, 'tourMap'])->name('tour.map');

Route::get('/locations', [KotaJailController::class, 'locations'])->name('locations.index');
Route::get('/locations/{slug}', [KotaJailController::class, 'locationDetail'])->name('locations.show');

Route::get('/plan-your-visit', [KotaJailController::class, 'planVisit'])->name('visit.plan');
Route::get('/visitor-information', [KotaJailController::class, 'visitorInfo'])->name('visitor.info');
Route::get('/gallery', [KotaJailController::class, 'gallery'])->name('gallery');
Route::get('/contact', [KotaJailController::class, 'contact'])->name('contact');
