<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\QuestionsController;
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

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'doLogin'])->name('_login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'doRegister'])->name('_register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['quiz'])->group(function () {
    Route::get('', [HomeController::class, 'index'])->name('home');
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
});


// Route::middleware(['auth'])->group(function () {
//     Route::name('mahasiswa.')->group(function () {
//         Route::prefix('mahasiswa')->group(function () {
//         });
//     });
// });

Route::group([
    'prefix' => 'mahasiswa',
    'middleware' => ['auth']
], function () {
    Route::name('mahasiswa.')->group(function () {
        Route::get('quiz', [MahasiswaController::class, 'quiz'])->name('quiz');
        Route::post('quiz', [MahasiswaController::class, 'storeQuiz'])->name('store.quiz');

        Route::middleware(['quiz'])->group(function () {
            Route::get('personal', [MahasiswaController::class, 'personal'])->name('personal');
            Route::post('personal', [MahasiswaController::class, 'store'])->name('store');
        });
    });
});

//admin
Route::middleware(['auth', 'auth.admin'])->group(function () {
    Route::name('admin.')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('dashboard', function () {
                return view('admin.dashboard');
            })->name('dashboard');
            Route::get('mahasiswa', [AdminController::class, 'mahasiswa'])->name('mahasiswa');
            Route::patch('verifikasi/{user}/{status}', [AdminController::class, 'verifikasi'])->name('verif-mahasiswa');

            Route::name('questions.')->group(function () {
                Route::prefix('questions')->group(function () {
                    Route::get('', [QuestionsController::class, 'index'])->name('index');
                    Route::get('create', [QuestionsController::class, 'create'])->name('create');
                    Route::post('', [QuestionsController::class, 'store'])->name('store');
                    Route::get('edit/{question}', [QuestionsController::class, 'edit'])->name('edit');
                    Route::patch('{question}', [QuestionsController::class, 'update'])->name('update');
                    Route::delete('{id}', [QuestionsController::class, 'delete'])->name('delete');
                });
            });
        });
    });
});
