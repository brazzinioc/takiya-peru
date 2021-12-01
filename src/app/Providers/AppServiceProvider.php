<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Song;
use App\Observers\SongObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        //Observers
        Song::observe(SongObserver::class);
    }
}
