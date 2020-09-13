<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use App\Helpers\Navigation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $nav = new Navigation;
        View::share('nav', $nav);

        Gate::before(function($user, $ability) {
            if ($user->hasPermission($ability)) {
                return true;
            }
        });
    }
}
