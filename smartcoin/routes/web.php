<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

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

Route::get('/dashboard', function () {
    $banks = Http::get('http://nigerianbanks.xyz')->json();
    return view('dashboard')->withBanks($banks);
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
