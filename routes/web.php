<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WinnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingPage\LandingPageController;
use App\Http\Controllers\users\export\ExportUsersController;

// Landing Page Controller
Route::controller(LandingPageController::class)->group(function () {
    Route::get('', 'index')->name('landingPage.index');
    Route::post('store', 'store')->name('landingPage.store');
});

Route::post('getWinner', [WinnerController::class, 'getWinner'])
    ->name('getWinner');

// Export Regsistered Users
Route::get('users/export', [ExportUsersController::class, 'export'])->name('users.export');

// Change Language
Route::get('locale/{locale}', function (string $locale) {
    session()->put('locale', $locale);
    return back();
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth
require __DIR__.'/auth.php';

