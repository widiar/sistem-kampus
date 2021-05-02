<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('about', function () {
    return view('about');
})->name('about');

Route::get('services', function () {
    return view('services');
})->name('services');

Route::prefix('portofolio')->group(function () {
    Route::get('', function () {
        return view('portofolio');
    })->name('portofolio');
    Route::get('details', function () {
        return view('portofolio-details');
    })->name('portofolio-details');
});

Route::get('team', function () {
    return view('team');
})->name('team');

Route::get('pricing', function () {
    return view('pricing');
})->name('pricing');

Route::get('blog', function () {
    return view('blog');
})->name('blog');

Route::get('contact', function () {
    return view('contact');
})->name('contact');
