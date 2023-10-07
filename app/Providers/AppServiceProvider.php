<?php

namespace App\Providers;

use App\Common\Models\Setting\Setting;
use App\Repositories\Eloquent\CurrencyExchangeRateRepository;
use App\Repositories\Eloquent\CurrencyRepository;
use App\Repositories\Eloquent\HistoryRepository;
use App\Repositories\Eloquent\IpRepository;
use App\Repositories\Eloquent\PageRepository;
use App\Repositories\Eloquent\PostCategoryRepository;
use App\Repositories\Eloquent\PostRepository;
use App\Repositories\Eloquent\RenderRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\ICurrencyExchangeRateRepository;
use App\Repositories\Interfaces\ICurrencyRepository;
use App\Repositories\Interfaces\IHistoryRepository;
use App\Repositories\Interfaces\IIpRepository;
use App\Repositories\Interfaces\IPageRepository;
use App\Repositories\Interfaces\IPostCategoryRepository;
use App\Repositories\Interfaces\IPostRepository;
use App\Repositories\Interfaces\IRenderRepository;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Support\Facades\View;
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

        $this->app->bind(ICurrencyExchangeRateRepository::class, CurrencyExchangeRateRepository::class);
        $this->app->bind(ICurrencyRepository::class, CurrencyRepository::class);
        $this->app->bind(IHistoryRepository::class, HistoryRepository::class);
        $this->app->bind(IIpRepository::class, IpRepository::class);
        $this->app->bind(IPageRepository::class, PageRepository::class);
        $this->app->bind(IPostCategoryRepository::class, PostCategoryRepository::class);
        $this->app->bind(IPostRepository::class, PostRepository::class);
        $this->app->bind(IRenderRepository::class, RenderRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('pagination', 'admin.pagination.default');
    }
}
