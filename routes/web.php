<?php

use App\Http\Livewire\Home\HomePage;
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

Route::get('/{slug?}', HomePage::class)->name('home.page')->middleware('handle.page.request');

Route::fallback(function () {
    if (request()->segment(1) == 'admin/login') {
        return redirect()->route('admin.login.form');
    }
    return abort(404);
});

// Route::get('/', function () {
//     return view('home.home');
// });


require __DIR__ . '/auth.php';
