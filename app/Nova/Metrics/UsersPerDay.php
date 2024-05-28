<?php

namespace App\Nova\Metrics;

use DateInterval;
use App\Models\User;
use DateTimeInterface;
use Laravel\Nova\Nova;
use Laravel\Nova\Metrics\Trend;
use Laravel\Nova\Http\Requests\NovaRequest;

class UsersPerDay extends Trend
{
    /**
     * Calculate the value of the metric.
     *
     * @param  NovaRequest $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->countByMonths($request, User::class);
        // return $this->countByMonths($request, User::class);

        // return $this->countByWeeks($request, User::class);

        // return $this->countByDays($request, User::class);

        // return $this->countByHours($request, User::class);

        // return $this->countByMinutes($request, User::class);
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            30 => Nova::__('30 Days'),
            60 => Nova::__('60 Days'),
            90 => Nova::__('90 Days'),
        ];
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return DateTimeInterface|DateInterval|float|int|null
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'users-per-day';
    }
}
