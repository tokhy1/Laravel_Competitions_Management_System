<?php

namespace App\Providers;

use App\Models\Competition;
use Illuminate\Support\Facades\View;
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
        View::composer('components.navbar', function ($view) {
            $competitions = Competition::get(['id', 'competition_name']);
            $view->with('competitions', $competitions);
        });
    }
}
