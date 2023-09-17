<?php

namespace App\Providers;

use App\Repositories\Eloquent\CurrencyExchangeRateRepository;
use App\Repositories\Eloquent\CurrencyRepository;
use App\Repositories\Eloquent\HistoryRepository;
use App\Repositories\Eloquent\IpRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\ICurrencyExchangeRateRepository;
use App\Repositories\Interfaces\ICurrencyRepository;
use App\Repositories\Interfaces\IHistoryRepository;
use App\Repositories\Interfaces\IIpRepository;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Sanctum::ignoreMigrations();

        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ICurrencyRepository::class, CurrencyRepository::class);
        $this->app->bind(ICurrencyExchangeRateRepository::class, CurrencyExchangeRateRepository::class);
        $this->app->bind(IIpRepository::class, IpRepository::class);
        $this->app->bind(IHistoryRepository::class, HistoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
