<?php

namespace App\Nova\Resources;

use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Metrics\CommentsPerNews;
use Laravel\Nova\Http\Requests\NovaRequest;

class Comment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Comment>
     */
    public static $model = \App\Models\Comment::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'comment_text';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'comment-text',
        'user_id',
        'news_id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            new Tabs('Comment', [
                'Details' => [
                    ID::make()->sortable(),

                    Text::make('Comment Text', 'comment-text')
                        ->sortable()
                        ->rules('required', 'max:255'),
                ],
                'Relations' => [
                    BelongsTo::make('User', 'user', User::class)
                        ->searchable()
                        ->sortable()
                        ->rules('required'),

                    BelongsTo::make('News', 'news', News::class)
                        ->searchable()
                        ->sortable()
                        ->rules('required'),
                ],
            ]),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            new CommentsPerNews];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
