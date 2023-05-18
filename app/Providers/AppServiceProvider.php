<?php

namespace App\Providers;

use App\Repositories\Implement\DokumenRepositoryImplement;
use App\Services\BerkasService;
use App\Services\DokumenService;
use App\Services\Implement\BerkasServiceImplement;
use App\Services\Implement\DokumenServiceImplement;
use App\Services\Implement\PengaturanServiceImplement;
use App\Services\Implement\PenilaianServiceImplement;
use App\Services\Implement\ProgramStudiServiceImplement;
use App\Services\Implement\TahunAkademikServiceImplement;
use App\Services\PengaturanService;
use App\Services\PenilaianService;
use App\Services\ProgramStudiService;
use App\Services\TahunAkademikService;
use App\Services\UserService;
use App\Services\Implement\UserServiceImplement;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserService::class, function (Application $app){
            return $app->make(UserServiceImplement::class);
        });
        $this->app->singleton(ProgramStudiService::class, function (Application $app){
            return $app->make(ProgramStudiServiceImplement::class);
        });
        $this->app->singleton(TahunAkademikService::class, function (Application $app){
            return $app->make(TahunAkademikServiceImplement::class);
        });
        $this->app->singleton(BerkasService::class, function (Application $app){
            return $app->make(BerkasServiceImplement::class);
        });
        $this->app->singleton(PenilaianService::class, function (Application $app){
            return $app->make(PenilaianServiceImplement::class);
        });
        $this->app->singleton(DokumenService::class, function (Application $app){
            return $app->make(DokumenServiceImplement::class);
        });
        $this->app->singleton(PengaturanService::class, function (Application $app){
            return $app->make(PengaturanServiceImplement::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
