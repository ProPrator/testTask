<?php

namespace App\Providers;

use App\Services\RaffleService;
use App\Services\RaffleServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application Services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            RaffleServiceInterface::class,
            RaffleService::class
        );
    }

    /**
     * Bootstrap any application Services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
