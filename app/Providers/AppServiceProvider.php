<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\KesehatanInterfaces',
            'App\Repositories\KesehatanRepository',
        );
        $this->app->bind(
            'App\Interfaces\HafalanInterfaces',
            'App\Repositories\HafalanRepository'
        );
        $this->app->bind(
            'App\Interfaces\WalimuridInterfaces',
            'App\Repositories\WalimuridRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
