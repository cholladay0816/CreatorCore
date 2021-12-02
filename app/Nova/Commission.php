<?php

namespace App\Nova;

use App\Nova\Actions\RefundCommissionDispute;
use App\Nova\Actions\ResolveCommissionDispute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Commission extends Resource
{
    public static $group = 'orders';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Commission::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'displayTitle';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'slug', 'displayTitle'
    ];

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (Gate::allows('manage-orders')) {
            return $query;
        }
        return $query->whereIn(
            'id',
            \App\Models\Commission::where('creator_id', $request->user()->id)
                ->orWhere('buyer_id', $request->user()->id)->get('id')
        );
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make('Buyer', 'buyer', '\App\Nova\User')->nullable(),
            BelongsTo::make('Creator', 'creator', '\App\Nova\User')->nullable(),
            BelongsTo::make('Commission Preset', 'preset')->nullable(),
            Text::make('Title'),
            Trix::make('Description'),
            Trix::make('Memo'),
            Currency::make('Price')
                ->min(5)
                ->max(1000)
                ->default(5),
            Select::make('Status')
                ->options(\App\Models\Commission::statuses())
                ->default('Unpaid'),
            Number::make('Days to Complete')
                ->default(7)
                ->min(1),
            DateTime::make('Expires At')
                ->nullable()
                ->hideWhenCreating(),
            HasMany::make('Attachments'),
            HasOne::make('Review')->nullable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new RefundCommissionDispute(),
            new ResolveCommissionDispute(),
        ];
    }
}
