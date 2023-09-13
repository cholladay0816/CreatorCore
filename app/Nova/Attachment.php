<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Attachment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Attachment::class;

    public static $group = 'orders';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'slug';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'slug'
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
        if (Gate::allows('manage-users')) {
            return $query;
        }
        return $query->whereIn('id', $request->user()->attachments->pluck('id'));
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
            Boolean::make('Can Be Edited', 'can_edit')->readonly(true),
            Boolean::make('Is Public', 'can_view')->readonly(true),
            BelongsTo::make('Commission', 'commission', 'App\Nova\Commission'),
            BelongsTo::make('User')->sortable()->filterable(),
            Text::make('Slug')->readonly(true)->exceptOnForms(),
            Image::make('Image', 'path', 'do')
                ->storeSize('size')
            ->preview(function ($path, $disk) {
                return Storage::temporaryUrl($path, now()->addMinute());
            })->hideFromIndex(),
            Number::make('Size')->readonly(true)->exceptOnForms(),
            Text::make('Path')->hideFromIndex()->readonly(true)->exceptOnForms()
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
        return [];
    }
}
