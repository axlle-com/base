<?php

namespace App\Providers;

use App\Repositories\Eloquent\CurrencyExchangeRateRepository;
use App\Repositories\Eloquent\CurrencyRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\ICurrencyExchangeRateRepository;
use App\Repositories\ICurrencyRepository;
use App\Repositories\IUserRepository;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
