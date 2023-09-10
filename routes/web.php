<?php

use App\Http\Livewire\Footer\CookiesPolicy;
use App\Http\Livewire\Footer\CopyrightAct;
use App\Http\Livewire\Footer\LeagalDisclaimer;
use App\Http\Livewire\Footer\PrivacyPolicy;
use App\Http\Livewire\Footer\TermOfUse;
use App\Http\Livewire\Home\HomePage;
use App\Models\PageHelp;
use Illuminate\Support\Facades\Route;

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


Route::get('send/form', function () {
    return view('sendForm');
});

Route::get('/storage/link', function () {
    $targetFolder = storage_path('app/public');
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder, $linkFolder);
});

Route::get('{lang}/terms-of-use', TermOfUse::class)->name('terms-of-use');
Route::get('{lang}/privacy-policy', PrivacyPolicy::class)->name('privacy-policy');
Route::get('{lang}/leagal-disclaimer', LeagalDisclaimer::class)->name('leagal-disclaimer');
Route::get('{lang}/copyright-act', CopyrightAct::class)->name('copyright-act');
Route::get('{lang}/cookies-policy', CookiesPolicy::class)->name('cookies-policy');

// Route::get('{lang}/terms-of-use', function () {
//     return view('terms-of-user');
// })->name('terms-of-use');


// Route::get('/test/help', function () {
//     $pageHelp = PageHelp::first()->toArray();
//     // dd($pageHelp);
//     return view('welcome', compact('pageHelp'));
// });

Route::get('/{slug?}', HomePage::class)
    ->name('home.page')
    ->middleware('handle.page.request');

Route::fallback(function () {
    if (request()->segment(1) == 'admin/login') {
        return redirect()->route('admin.login.form');
    }
    return abort(404);
});



require __DIR__ . '/auth.php';
