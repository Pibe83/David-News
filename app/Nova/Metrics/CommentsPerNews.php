<?php

namespace App\Nova\Metrics;

use DateInterval;
use DateTimeInterface;
use App\Models\Comment;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Http\Requests\NovaRequest;

class CommentsPerNews extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  NovaRequest $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Comment::class, 'id');
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
        return 'comments-per-news';
    }
}
