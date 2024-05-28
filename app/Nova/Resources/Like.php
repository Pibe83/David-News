<?php

namespace App\Nova\Resources;

use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use App\Nova\Metrics\LikePerNews;
use Laravel\Nova\Http\Requests\NovaRequest;

class Like extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Like>
     */
    public static $model = \App\Models\Like::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'user_id',
        'likeable_id',
        'likeable_type',
        'content_type',
        'content_id',
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
            new Tabs('Like', [
                'Details' => [
                    ID::make()->sortable(),

                    Number::make('User ID', 'user_id')
                        ->sortable()
                        ->rules('required'),

                    Number::make('Likeable ID', 'likeable_id')
                        ->sortable()
                        ->rules('required'),
                ],
                'Types' => [
                    Text::make('Likeable Type', 'likeable_type')
                        ->sortable()
                        ->rules('required', 'max:255'),

                    Text::make('Content Type', 'content_type')
                        ->sortable()
                        ->rules('required', 'max:255'),

                    Number::make('Content ID', 'content_id')
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
            new LikePerNews, ];
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
