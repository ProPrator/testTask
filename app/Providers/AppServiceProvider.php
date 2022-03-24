<?php

namespace App\Providers;

use App\Models\MoneyTransportInterface;
use App\Models\SberTransport;
use App\Services\BonusService;
use App\Services\BonusServiceInterface;
use App\Services\ItemService;
use App\Services\ItemServiceInterface;
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

        $this->app->bind(
            MoneyTransportInterface::class,
            SberTransport::class
        );

        $this->app->bind(
            ItemServiceInterface::class,
            ItemService::class
        );

        $this->app->bind(
            BonusServiceInterface::class,
            BonusService::class
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
