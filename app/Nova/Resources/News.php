<?php

namespace App\Nova\Resources;

use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Heading;
use App\Nova\Metrics\NewsAverage;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class News extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\News>
     */
    public static $model = \App\Models\News::class;

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
        'title',
        'subtitle',
        'content',
        'slug',
        'photo',
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
            new Tabs('Post', [
                'Main' => [
                    ID::make()->sortable(),

                    Heading::make('<p class="text-danger">* All fields are required.</p>')->asHtml(),

                    Text::make('Title', 'title')
                        ->sortable()
                        ->rules('required', 'max:255'),

                    Text::make('Subtitle', 'subtitle')
                        ->sortable()
                        ->rules('max:255', 'required'),

                    Textarea::make('Content', 'content')
                        ->sortable()
                        ->rules('required'),
                ],
                'Metadata' => [
                    Text::make('Slug')
                        ->sortable()
                        ->nullable(),

                    BelongsTo::make('User', 'user', User::class)
                        ->sortable(),
                ],
                'Comments' => [
                    HasMany::make('Comments', 'comments', Comment::class),
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
            new NewsAverage];
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
