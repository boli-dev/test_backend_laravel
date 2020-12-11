<?php

namespace App\Providers;

use App\Services\Game;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton(Game::class, function ($app) {
            return new Game(request()->query('total'),
                request()->query('baseline'),
                request()->query('date1'),
                request()->query('date2'));
        });
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
