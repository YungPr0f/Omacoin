<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Models\Bank;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('dashboard', DashboardController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/profile_update', [DashboardController::class, 'profile_update'])->name('profile.update');

// Route::get('/dashboard', function () {
//     $userbank = Bank::where('id', Auth::user()->bank_id)->first();
//     // $banks = Http::get('http://nigerianbanks.xyz')->json();
//     $banks = Bank::all();
//     return view('dashboard')->withBanks($banks)->withUserbank($userbank);
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
