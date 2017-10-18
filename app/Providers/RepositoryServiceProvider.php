<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Interfaces\LogRepositoryInterface', 
            'App\Repositories\Storage\LogRepository');
        $this->app->bind('App\Repositories\Interfaces\BookingRepositoryInterface', 
            'App\Repositories\Storage\BookingRepository');
        $this->app->bind('App\Repositories\Interfaces\TurnRepositoryInterface', 
            'App\Repositories\Storage\TurnRepository');
    }
}
