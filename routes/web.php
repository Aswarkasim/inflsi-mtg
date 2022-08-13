<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDesaController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminPasarController;
use App\Http\Controllers\AdminSaranController;
use App\Http\Controllers\HomeBeritaController;
use App\Http\Controllers\AdminBannerController;
use App\Http\Controllers\AdminSurveyController;
use App\Http\Controllers\HomeContactController;
use App\Http\Controllers\HomeKomoditiController;
use App\Http\Controllers\AdminKomoditiController;
use App\Http\Controllers\AdminKecamatanController;
use App\Http\Controllers\AdminRekapSurveyController;
use App\Http\Controllers\AdminCategoryPostController;
use App\Http\Controllers\AdminSurveyDetailController;
use App\Http\Controllers\AdminConfigurationController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminRegionController;
use App\Http\Controllers\AdminSatuanController;
use App\Http\Controllers\HomeLaporanController;

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

Route::get('/', [HomeController::class, 'index']);



Route::prefix('/admin/auth')->group(function () {
    Route::get('/', [AdminAuthController::class, 'index'])->middleware('guest')->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::get('/register', [AdminAuthController::class, 'register']);
    Route::post('/doRegister', [AdminAuthController::class, 'doRegsiter']);
    Route::get('/logout', [AdminAuthController::class, 'logout']);
});


Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);

    Route::resource('/user', AdminUserController::class);

    Route::get('/konfigurasi', [AdminConfigurationController::class, 'index']);


    Route::put('/konfigurasi/update', [AdminConfigurationController::class, 'update']);

    Route::prefix('/rekap')->group(function () {
        Route::get('/', [AdminRekapSurveyController::class, 'index']);
        Route::get('/detail/{id}', [AdminRekapSurveyController::class, 'detail']);
        Route::get('/create', [AdminRekapSurveyController::class, 'create']);
        Route::delete('/delete/{id}', [AdminRekapSurveyController::class, 'delete']);
    });

    Route::prefix('/survey')->group(function () {
        Route::post('/detail', [AdminSurveyDetailController::class, 'create']);
        Route::get('/detail/update', [AdminSurveyController::class, 'updateHarga']);
    });

    Route::resource('/survey', AdminSurveyController::class);
    Route::resource('/komoditi/satuan', AdminSatuanController::class);
    Route::resource('/komoditi/komoditi', AdminKomoditiController::class);
    Route::resource('/banner', AdminBannerController::class);


    Route::prefix('/posts')->group(function () {
        Route::resource('/post', AdminPostController::class);
        Route::resource('/kategori', AdminCategoryPostController::class);
    });

    Route::get('/saran', [AdminSaranController::class, 'index']);
    Route::get('/saran/show/{id}', [AdminSaranController::class, 'detail']);
    Route::get('/saran/delete/{id}', [AdminSaranController::class, 'delete']);

    Route::prefix('/master')->group(function () {
        Route::resource('/kecamatan', AdminKecamatanController::class);

        Route::resource('/desa', AdminDesaController::class);
        Route::resource('/pasar', AdminPasarController::class);
    });
});


Route::get('/region/get-desa/{id}', [AdminRegionController::class, 'getDesa']);
Route::get('/region/get-pasar/{id}', [AdminRegionController::class, 'getPasar']);
Route::get('/region/get-pasar-by-kecamatan/{id}', [AdminRegionController::class, 'getPasarByKecamatan']);

Route::prefix('/home')->group(function () {
    // Route::resource('/layanan', HomeLayananController::class);;
});
Route::get('/komoditi', [HomeKomoditiController::class, 'index']);
Route::get('/berita', [HomeBeritaController::class, 'index']);
Route::get('/contact', [HomeContactController::class, 'index']);
Route::post('/contact/send', [HomeContactController::class, 'sendSaran']);
Route::get('/laporan', [HomeLaporanController::class, 'index']);
