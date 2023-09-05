<?php

namespace App\Providers;

use App\Contracts\UpdatesCreatorInformation;
use App\Models\Creator;
use App\Models\User;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Register a class / callback that should be used to update user profile information.
     *
     * @param  string  $callback
     * @return void
     */
    public static function updateCreatorInformationUsing(string $callback)
    {
        app()->singleton(UpdatesCreatorInformation::class, $callback);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this::updateCreatorInformationUsing(UpdatesCreatorInformation::class);

        Collection::macro('sortByDate', function (string $column = 'created_at', bool $descending = true) {
            /* @var $this Collection */
            return $this->sortBy(function ($datum) use ($column) {
                return strtotime(((object)$datum)->$column);
            }, SORT_REGULAR, $descending);
        });
    }
}
