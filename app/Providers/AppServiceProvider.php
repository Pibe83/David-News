<?php

namespace App\Providers;

use App\Models\News;
use App\Models\Quotation;
use App\Observers\NewsObserver;
use App\Observers\QuotationObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        News::observe(NewsObserver::class);
        Quotation::observe(QuotationObserver::class);
    }
}
