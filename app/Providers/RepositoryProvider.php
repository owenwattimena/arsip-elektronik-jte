<?php

namespace App\Providers;

use App\Repositories\BerkasRepository;
use App\Repositories\DokumenRepository;
use App\Repositories\DosenPlpRepository;
use App\Repositories\Implement\BerkasRepositoryImplement;
use App\Repositories\Implement\DokumenRepositoryImplement;
use App\Repositories\Implement\DosenPlpRepositoryImplement;
use App\Repositories\Implement\InformasiRepositoryImplement;
use App\Repositories\Implement\PengaturanRepositoryImplement;
use App\Repositories\Implement\PenilaianRepositoryImplement;
use App\Repositories\Implement\ProgramStudiRepositoryImplement;
use App\Repositories\Implement\TahunAkademikRepositoryImplement;
use App\Repositories\Implement\UserRepositoryImplement;
use App\Repositories\InformasiRepository;
use App\Repositories\PengaturanRepository;
use App\Repositories\PenilaianRepository;
use App\Repositories\ProgramStudiRepository;
use App\Repositories\TahunAkademikRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
class RepositoryProvider extends ServiceProvider
{

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(UserRepository::class, function(Application $app){
            return $app->make(UserRepositoryImplement::class);
        });
        $this->app->singleton(DosenPlpRepository::class, function(Application $app){
            return $app->make(DosenPlpRepositoryImplement::class);
        });
        $this->app->singleton(ProgramStudiRepository::class, function(Application $app){
            return $app->make(ProgramStudiRepositoryImplement::class);
        });
        $this->app->singleton(TahunAkademikRepository::class, function(Application $app){
            return $app->make(TahunAkademikRepositoryImplement::class);
        });
        $this->app->singleton(BerkasRepository::class, function(Application $app){
            return $app->make(BerkasRepositoryImplement::class);
        });
        $this->app->singleton(PenilaianRepository::class, function(Application $app){
            return $app->make(PenilaianRepositoryImplement::class);
        });
        $this->app->singleton(DokumenRepository::class, function(Application $app){
            return $app->make(DokumenRepositoryImplement::class);
        });
        $this->app->singleton(PengaturanRepository::class, function(Application $app){
            return $app->make(PengaturanRepositoryImplement::class);
        });
        $this->app->singleton(InformasiRepository::class, function(Application $app){
            return $app->make(InformasiRepositoryImplement::class);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
