<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KonsentrasiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\QuestionsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::get('forgot-password', function () {
    return view('auth.forgotpw');
})->name('forgotpw');
Route::post('forgot-password', [AuthController::class, 'forgot']);

Route::get('reset-password/', [AuthController::class, 'reset'])->name('resetPass');
Route::post('reset-password/', [AuthController::class, 'postReset']);

Route::get('kurikulum', [HomeController::class, 'kurikulum'])->name('kurikulum');

Route::middleware(['quiz'])->group(function () {
    Route::get('', [HomeController::class, 'index'])->name('home');
    Route::get('mahasiswa/{nim}/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('list/profile', [HomeController::class, 'listProfile'])->name('list.profile');
    Route::get('nilai/{nim}', [HomeController::class, 'nilai'])->name('nilai.mhs');

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


Route::middleware(['auth', 'quiz'])->group(function () {
    Route::name('cv.')->group(function () {
        Route::prefix('profile/create')->group(function () {
            Route::get('', [CVController::class, 'index'])->name('index');
            // Route::post('', [CVController::class, 'post']);
            Route::post('', [CVController::class, 'postProfile']);
        });
    });
});


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
            Route::get('alumni', [MahasiswaController::class, 'alumni'])->name('alumni');
            Route::post('alumni', [MahasiswaController::class, 'storeAlumni']);
            Route::get('getKonsentrasi/{id}', [MahasiswaController::class, 'getKonsentrasi'])->name('getKonsentrasi');

            Route::get('konsentrasi/detail/{id}', [MahasiswaController::class, 'detailKonsentrasi'])->name('detail.konsentrasi');

            Route::prefix('nilai')->group(function () {
                Route::get('', [MahasiswaController::class, 'nilai'])->name('nilai');
                Route::get('add', [MahasiswaController::class, 'addNilai'])->name('nilai.add');
                Route::post('', [MahasiswaController::class, 'storeNilai'])->name('nilai.store');
                Route::get('semester-{smt}', [MahasiswaController::class, 'show'])->name('nilai.show');
                Route::get('edit/semester-{smt}', [MahasiswaController::class, 'editNilai'])->name('nilai.edit');
                Route::get('delete/semester-{smt}', [MahasiswaController::class, 'deleteNilai'])->name('nilai.delete');
                Route::patch('{smt}', [MahasiswaController::class, 'updateNilai'])->name('nilai.update');
            });
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
            Route::get('mahasiswa/register', [AdminController::class, 'mahasiswa'])->name('mahasiswa');
            Route::patch('verifikasi/{user}/{status}', [AdminController::class, 'verifikasi'])->name('verif-mahasiswa');

            Route::name('mahasiswa.')->group(function () {
                Route::prefix('mahasiswa')->group(function () {
                    Route::get('nilai', [AdminController::class, 'nilaiMahasiswa'])->name('nilai');
                    Route::get('nilai/verif/{mhs}', [AdminController::class, 'verifNilai'])->name('verif.nilai');
                    Route::post('get-nilai', [AdminController::class, 'getNilai'])->name('getNilai');
                    Route::patch('update-nilai', [AdminController::class, 'updateNilai'])->name('nilai.update');
                });
            });

            Route::name('questions.')->group(function () {
                Route::prefix('questions')->group(function () {
                    Route::get('', [QuestionsController::class, 'index'])->name('index');
                    Route::get('create', [QuestionsController::class, 'create'])->name('create');
                    Route::post('', [QuestionsController::class, 'store'])->name('store');
                    Route::get('edit/{question}', [QuestionsController::class, 'edit'])->name('edit');
                    Route::patch('{question}', [QuestionsController::class, 'update'])->name('update');
                    Route::delete('{id}', [QuestionsController::class, 'delete'])->name('delete');

                    Route::prefix('category')->group(function () {
                        Route::get('', [QuestionsController::class, 'categoryIndex'])->name('category');
                        Route::get('create', [QuestionsController::class, 'categoryCreate'])->name('category.create');
                        Route::post('create', [QuestionsController::class, 'categoryStore']);
                        Route::get('edit/{category}', [QuestionsController::class, 'categoryEdit'])->name('category.edit');
                        Route::put('{category}', [QuestionsController::class, 'categoryUpdate'])->name('category.update');
                        Route::delete('{category}', [QuestionsController::class, 'categoryDelete'])->name('category.delete');
                    });
                });
            });

            Route::name('jurusan.')->group(function () {
                Route::prefix('jurusan')->group(function () {
                    Route::get('', [JurusanController::class, 'index'])->name('index');
                    Route::get('create', [JurusanController::class, 'create'])->name('create');
                    Route::post('', [JurusanController::class, 'store'])->name('store');
                    Route::get('edit/{jurusan}', [JurusanController::class, 'edit'])->name('edit');
                    Route::patch('{jurusan}', [JurusanController::class, 'update'])->name('update');
                    Route::delete('{id}', [JurusanController::class, 'delete'])->name('delete');
                });
            });

            Route::resource('konsentrasi', KonsentrasiController::class);

            Route::name('matakuliah.')->group(function () {
                Route::prefix('mata-kuliah')->group(function () {
                    Route::get('', [MataKuliahController::class, 'index'])->name('index');
                    Route::get('create', [MataKuliahController::class, 'create'])->name('create');
                    Route::post('', [MataKuliahController::class, 'store'])->name('store');
                    Route::get('edit/{matakuliah}', [MataKuliahController::class, 'edit'])->name('edit');
                    Route::patch('{matakuliah}', [MataKuliahController::class, 'update'])->name('update');
                    Route::delete('{id}', [MataKuliahController::class, 'delete'])->name('delete');
                });
            });
        });
    });
});
