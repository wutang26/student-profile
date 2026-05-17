<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

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


public function boot()
{
    View::composer('*', function ($view) {
        if (auth()->check()) {

            /** @var User $user */
            $user = auth()->user();

            $permissions = $user->roles
                ->load('permissions')
                ->pluck('permissions')
                ->flatten()
                ->pluck('name')
                ->unique()
                ->toArray();

            $view->with('userPermissions', $permissions);
        }
    });

    // //For Bootstrap Pagination
    Paginator::defaultView('pagination::simple-default');
}




}




