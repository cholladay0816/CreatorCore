<?php

namespace App\Nova;

use App\Nova\Actions\Suspend;
use App\Nova\Actions\Strike;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{
    public static $group = 'users';
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
        'id', 'name', 'email',
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
        return $query->where('id', $request->user()->id);
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Avatar::make('Profile Photo', 'profile_photo_path')->disk('do_public')
                ->aspect('aspect-square'),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Boolean::make('Onboarded', 'onboarded_at')->onlyOnIndex()->sortable()->filterable(),
            BelongsTo::make('Affiliate')->nullable()->sortable()->filterable(),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults()),

            Text::make('Stripe Customer ID', 'stripe_id')->hideFromIndex(),
            Text::make('Stripe Account ID')->hideFromIndex(),
            Text::make('Google ID')->nullable()->hideFromIndex(),

            HasMany::make('Roles', 'roles', 'App\Nova\Role'),
            HasMany::make('Reports', 'reports', 'App\Nova\Report'),
            HasMany::make('Strikes', 'strikes', 'App\Nova\Strike'),
            HasMany::make('Suspensions', 'suspensions', 'App\Nova\Suspension'),
            DateTime::make('Created At')->sortable()->filterable()->hideWhenCreating(),
            DateTime::make('Updated At')->sortable()->filterable()->hideWhenUpdating(),
            DateTime::make('Onboarded At')->nullable()->sortable()->filterable(),
            DateTime::make('Email Verified At')->nullable()->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            Strike::make(),
            Suspend::make()
        ];
    }
}
