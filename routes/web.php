<?php

use App\Http\Controllers\Admin\DokumenController;
use App\Http\Controllers\Admin\PemberitahuanController;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Admin\TahunAkademikController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dosen\MainController;
use App\Models\Penilaian;
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

Route::get('/', function () {
    // $data = Penilaian::with(['berkas'=>function($query){
    //     return $query->with(['tahunAkademik','dosenPlpProdi'=>function($query){
    //         return $query->with(['dosenPlp', 'prodi']);
    //     }]);
    // }])->findOrFail(1);
    // dd($data);
    if(Auth::check())
    {
        if(Auth::user()->role == 'admin')
        {
            return redirect()->route('admin.main');
        }
        return redirect()->route('dosen.main');
    }
    return redirect()->route('auth.login');

})->name('/');
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
        Route::get('/penilaian/plp', [\App\Http\Controllers\Dosen\PenilaianController::class, 'index']); // tidak diberi nama agar tidak conflic
        Route::get('/penilaian/prodi/{id}', [\App\Http\Controllers\Dosen\PenilaianController::class, 'index'])->name('dosen.penilaian');
        Route::post('/penilaian/prodi/{id}', [\App\Http\Controllers\Dosen\PenilaianController::class, 'create'])->name('dosen.penilaian.create');
        Route::put('/penilaian/prodi/{id}/berkas/{berkasId}', [\App\Http\Controllers\Dosen\PenilaianController::class, 'update'])->name('dosen.penilaian.update');
        Route::get('/profil', [\App\Http\Controllers\Dosen\UserController::class, 'index'])->name('dosen.profil');
        Route::put('/profil', [\App\Http\Controllers\Dosen\UserController::class, 'update'])->name('dosen.profil.update');
        Route::put('/profil/change-password', [\App\Http\Controllers\Dosen\UserController::class, 'changePassword'])->name('dosen.profil.change-password');
        Route::get('/dokumen/sk', [\App\Http\Controllers\Dosen\DokumenController::class, 'suratKeterangan'])->name('dosen.dokumen.sk');
        Route::get('/dokumen/surat-tugas', [\App\Http\Controllers\Dosen\DokumenController::class, 'suratTugas'])->name('dosen.dokumen.surat-tugas');

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

        Route::get('/dokumen/sk', [DokumenController::class, 'suratKetetapan'])->name('admin.dokumen.sk');
        Route::get('/dokumen/surat-tugas', [DokumenController::class, 'suratTugas'])->name('admin.dokumen.surat-tugas');
        Route::post('/dokumen', [DokumenController::class, 'create'])->name('admin.dokumen.create');

        Route::get('/pemberitahuan', [PemberitahuanController::class, 'index'])->name('admin.informasi');
        Route::post('/pemberitahuan', [PemberitahuanController::class, 'create'])->name('admin.informasi.create');
        Route::delete('/pemberitahuan', [PemberitahuanController::class, 'delete'])->name('admin.informasi.delete');

        Route::get('user', [UserController::class, 'index'])->name('admin.user');
        Route::get('user/{id}', [UserController::class, 'biodata'])->name('admin.user.biodata');
        Route::put('user/{id}/ganti-password', [UserController::class, 'changePassword'])->name('admin.user.change-password');
        Route::post('user', [UserController::class, 'create'])->name('admin.user.create');


    });
    Route::get('keluar', function(){
        Auth::logout();
        return redirect()->route('auth.login');
    })->name('auth.keluar');
});
