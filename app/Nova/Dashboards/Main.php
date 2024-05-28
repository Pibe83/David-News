<?php

namespace App\Nova\Dashboards;

use Laravel\Nova\Cards\Help;
use App\Nova\Metrics\LikePerNews;
use App\Nova\Metrics\NewsAverage;
use App\Nova\Metrics\UsersPerDay;
use App\Nova\Metrics\NewQuotation;
use App\Nova\Metrics\CommentsPerNews;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new Help,
            new NewQuotation,
            new UsersPerDay,
            new NewsAverage,
            new CommentsPerNews,
            new LikePerNews,
        ];
    }
}
