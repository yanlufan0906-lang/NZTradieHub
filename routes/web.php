<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ComingSoonController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DemoAccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuoteController;

if (! config('platform.api_connected')) {
    Route::get('/', [ComingSoonController::class, 'index'])->name('home');

    Route::match(
        ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
        '/{any}',
        [ComingSoonController::class, 'index']
    )->where('any', '.*');
} else {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/businesses', [BusinessController::class, 'index'])->name('businesses.index');
    Route::get('/businesses/register', [BusinessController::class, 'register'])->name('businesses.register');
    Route::post('/businesses/register', [BusinessController::class, 'storeRegistration'])->name('businesses.register.store');
    Route::get('/businesses/{slug}', [BusinessController::class, 'show'])->name('businesses.show');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

    Route::get('/quote', [QuoteController::class, 'create'])->name('quote.create');
    Route::post('/quote', [QuoteController::class, 'store'])->name('quote.store');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    Route::get('/pages/{page}', [PageController::class, 'show'])->name('pages.show');
}
