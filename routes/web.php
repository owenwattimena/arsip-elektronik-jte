<?php

use App\Http\Controllers\Admin\DokumenController;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Admin\TahunAkademikController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dosen\MainController;
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

// Route::get('/', function () {
//     return view('welcome');
// })->name('/');
Route::get('/index.html', function () {
    return view('dashboard.templates.index');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/masuk.html', [LoginController::class, 'index'])->name('auth.login');
    Route::post('/masuk.html', [LoginController::class, 'login'])->name('auth.login.post');
    // Route::get('/daftar.html', [RegisterController::class, 'index'])->name('auth.register');
    // Route::post('/daftar.html', [RegisterController::class, 'create'])->name('auth.register.post');
});
Route::middleware(['auth'])->group(function () {

    Route::prefix('dosen_plp')->middleware(['dosen_plp'])->group(function(){
        Route::get('/home.html', [MainController::class, 'index'])->name('dosen.main');
        Route::get('/profile.html', [\App\Http\Controllers\PengaturanController::class, 'index'])->name('dosen.profile');
        Route::get('/penilaian/prodi/{id}', [\App\Http\Controllers\Dosen\PenilaianController::class, 'index'])->name('dosen.penilaian');
        Route::post('/penilaian/prodi/{id}', [\App\Http\Controllers\Dosen\PenilaianController::class, 'create'])->name('dosen.penilaian.create');
        Route::get('/profil', [\App\Http\Controllers\Dosen\UserController::class, 'index'])->name('dosen.profil');
        Route::put('/profil', [\App\Http\Controllers\Dosen\UserController::class, 'update'])->name('dosen.profil.update');
        Route::put('/profil/change-password', [\App\Http\Controllers\Dosen\UserController::class, 'changePassword'])->name('dosen.profil.change-password');
        Route::get('/dokumen', [\App\Http\Controllers\Dosen\DokumenController::class, 'index'])->name('dosen.dokumen');

    });
    Route::prefix('admin')->middleware(['admin'])->group(function(){
        Route::get('/home.html', [\App\Http\Controllers\Admin\MainController::class, 'index'])->name('admin.main');
        Route::get('/profile.html', [\App\Http\Controllers\PengaturanController::class, 'index'])->name('admin.profile');
        Route::post('/profile.html', [\App\Http\Controllers\PengaturanController::class, 'createOrUpdate'])->name('admin.profile.post');


        Route::get('/program-studi.html', [ProgramStudiController::class, 'index'])->name('admin.prodi');
        Route::post('/program-studi.html', [ProgramStudiController::class, 'create'])->name('admin.prodi.create');

        Route::get('/tahun-akademik.html', [TahunAkademikController::class, 'index'])->name('admin.tahun-akademik');
        Route::post('/tahun-akademik.html', [TahunAkademikController::class, 'create'])->name('admin.tahun-akademik.create');

        Route::get('/penilaian/prodi/{id}', [PenilaianController::class, 'index'])->name('admin.penilaian');
        Route::get('/penilaian/prodi/{id}/dosen-plp/{dosenPlpId}', [PenilaianController::class, 'nilai'])->name('admin.penilaian.nilai');
        Route::post('/penilaian/prodi/{id}/dosen-plp/{dosenPlpId}', [PenilaianController::class, 'create'])->name('admin.penilaian.nilai.create');

        Route::get('/dokumen', [DokumenController::class, 'index'])->name('admin.dokumen');
        Route::post('/dokumen', [DokumenController::class, 'create'])->name('admin.dokumen.create');

        Route::get('user', [UserController::class, 'index'])->name('admin.user');
        Route::post('user', [UserController::class, 'create'])->name('admin.user.create');
    });
    Route::get('keluar', function(){
        Auth::logout();
        return redirect()->route('auth.login');
    })->name('auth.keluar');
});