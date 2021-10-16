<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Models\Bank;
use App\Models\Wallet;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionController;
// use App\Http\Controllers\AdminController;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
    return view('welcome')->withPlatforms(platforms())->withCurrencies(currencies())
        ->withWallets(Wallet::where('status', 1)->get())->withBanks(Bank::all());
});


Route::get('/qr', function() {
    // walletQR('12345', public_path('img/ui/qrtest.png'));
    // return QrCode::size(1000)->generate('boy');
    // echo '<img src="data:image/png;base64,' . base64_encode(QrCode::format('png')->size(500)->merge('/public/img/logo/smartcoin2.png', .25)->errorCorrection('H')->generate('boy')) .'">';=
    // walletQR('3LfV7Zna8gG6SGUrWLaGkLHjpVcbiX7rnW', '../public/img/wallets/qrcode1.png');
    // return QrCode::format('png')->size(500)->merge('/public/img/logo/OmaCoin.png')->errorCorrection('H')->generate('Make me into a QrCode!');
    // echo '<img src="data:image/png;base64,' . base64_encode(QrCode::format('png')->size(500)->merge('/public/img/logo/smartcoin2.png', .3)->errorCorrection('H')->generate('Make me into a QrCode!')) .'">';
    // return URL::asset('img/logo/OmaCoin.png');
});

Route::get('/ref', function() {
    echo(bin2hex(random_bytes(4)));
});

// Route::resource('dashboard', DashboardController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/profile_update', [DashboardController::class, 'profile_update'])->name('profile.update');

Route::post('/qr_preview', [WalletController::class, 'qr_preview'])->name('wallet.qr_gen');

Route::post('/qr_delete', [WalletController::class, 'qr_delete'])->name('wallet.qr_del');

Route::resource('wallet', WalletController::class);

Route::resource('transaction', TransactionController::class);

// Route::get('/dashboard', function () {
//     $userbank = Bank::where('id', Auth::user()->bank_id)->first();
//     // $banks = Http::get('http://nigerianbanks.xyz')->json();
//     $banks = Bank::all();
//     return view('dashboard')->withBanks($banks)->withUserbank($userbank);
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
