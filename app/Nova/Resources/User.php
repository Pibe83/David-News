<?php

namespace App\Nova\Resources;

use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\HasMany;
use App\Nova\Metrics\UsersPerDay;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\UiAvatar;
use Laravel\Nova\Fields\VaporFile;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Actions\SendWelcomeEmailAction;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\User>
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
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
            new Tabs('User', [
                'Profile' => [
                    ID::make()->sortable(),

                    UiAvatar::make('Avatar', 'full_name'),

                    Text::make(__('Name'), 'name')
                        ->default('Mario')
                        ->sortable()
                        ->rules('required', 'max:255'),

                    Date::make('Birthday', 'birthday'),

                    Slug::make('Slug')->from('Name'),

                    Text::make(__('Job Title'), 'job_title')
                        ->sortable()
                        ->rules('required', 'max:255'),
                ],
                'Account' => [
                    Text::make('Email')
                        ->sortable()
                        ->rules('required', 'email', 'max:254')
                        ->creationRules('unique:users,email')
                        ->updateRules('unique:users,email,{{resourceId}}'),

                    Password::make('Password')
                        ->onlyOnForms()
                        ->creationRules('required', Rules\Password::defaults())
                        ->updateRules('nullable', Rules\Password::defaults()),
                ],
                'Documents' => [
                    VaporFile::make('Document'),

                    Text::make('Phone Number')->textAlign('left'),
                ],
                'Comments' => [
                    HasMany::make('Comments', 'comments', Comment::class),
                ],
                'Likes' => [
                    HasMany::make('Likes', 'likes', Like::class),
                ],
                'News' => [
                    HasMany::make('News', 'news', News::class),
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
            new UsersPerDay, ];
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
        return [
            new SendWelcomeEmailAction,
        ];
    }
}
