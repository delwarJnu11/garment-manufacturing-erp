<?php

namespace App\Providers;

// use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // ✅ Add this line
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

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
        View::composer('layout.backend.header', function ($view) {
            $user = Auth::user();
            $notifications = $user ? $user->unreadNotifications : collect();
            $view->with('headerNotifications', $notifications);
        });
        Paginator::useBootstrap();
    }
}
