<?php

namespace App\Providers;

use App\Models\Link;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set the locale to Indonesian
    \Carbon\Carbon::setLocale('id');
        view()->composer('*', function ($view) {
            $links = Link::all();
            $view->with('links', $links);
        });
        //
        Paginator::useBootstrap();
        Gate::before(function($user, $ability) {
            if($user->hasRole('super_admin')) {
                return true;
            }
        });
    }
}
