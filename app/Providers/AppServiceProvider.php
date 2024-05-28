<?php

namespace App\Providers;

use App\Models\News;
use App\Models\Quotation;
use App\Observers\NewsObserver;
use App\View\Components\AppLayout;
use App\Observers\QuotationObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    /**
     * Register any application services.
     */
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // News::observe(NewsObserver::class);

        Quotation::observe(QuotationObserver::class);

        Blade::component('app-layout', AppLayout::class);
    }
}
