<?php

namespace App\Nova\Metrics;

use DateInterval;
use App\Models\Like;
use DateTimeInterface;
use Laravel\Nova\Metrics\Progress;
use Laravel\Nova\Http\Requests\NovaRequest;

class LikePerNews extends Progress
{
    /**
     * Calculate the value of the metric.
     *
     * @param  NovaRequest $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Like::class, function ($query) {
            return $query;
        }, target: 100);
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return DateTimeInterface|DateInterval|float|int
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
        return 'like-per-news';
    }
}