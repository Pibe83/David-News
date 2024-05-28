<?php

namespace App\Providers;

use Laravel\Nova\Nova;
use App\Nova\Resources\Like;
use App\Nova\Resources\News;
use App\Nova\Resources\User;
use App\Nova\Resources\Comment;
use App\Nova\Resources\Quotation;
use App\Nova\Lenses\HighValueOrders;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    public function resources()
    {
        Nova::resources([
            Quotation::class,
            User::class,
            Comment::class,
            News::class,
            Like::class,
        ]);
    }

    public function lenses()
    {
        return [
            new HighValueOrders(),
        ];
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }
}
