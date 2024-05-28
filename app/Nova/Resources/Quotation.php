<?php

namespace App\Nova\Resources;

use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use App\Nova\Metrics\NewQuotation;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Lenses\HighValueOrders;
use Laravel\Nova\Http\Requests\NovaRequest;

class Quotation extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Quotation>
     */
    public static $model = \App\Models\Quotation::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id'; // Aggiornato il title con un attributo valido

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'total_price',
        'taxable_price',
        'tax_price',
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
            new Tabs('Order', [
                'Prices' => [
                    ID::make()->sortable(),

                    Number::make('Total Price', 'total_price')
                        ->sortable()
                        ->rules('required', 'numeric'),

                    Number::make('Taxable Price', 'taxable_price')
                        ->sortable()
                        ->rules('required', 'numeric'),

                    Number::make('Tax Price', 'tax_price')
                        ->sortable()
                        ->rules('required', 'numeric'),
                ],
                'User' => [
                    BelongsTo::make('User', 'user', User::class)
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
            new NewQuotation];
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
    public function lenses(Request $request)
    {
        return [
            new HighValueOrders(),
        ];
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
