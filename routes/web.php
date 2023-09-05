<?php

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

Route::get('/storage/link', function () {
    $targetFolder = storage_path('app/public');
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder, $linkFolder);
});

Route::get('/terms-of-use', function () {
    return view('terms-of-user');
})->name('terms-of-use');


Route::get('/test/help', function () {
    $pageHelp = PageHelp::first()->toArray();
    // dd($pageHelp);
    return view('welcome', compact('pageHelp'));
});

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
