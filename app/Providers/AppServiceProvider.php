<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // ✅ Add this line

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
<<<<<<< HEAD
    public function boot(): void {
        Paginator::useBootstrap();
=======
    public function boot(): void
    {
        Paginator::useBootstrap(); // ✅ Ensure this line is here
>>>>>>> 339dedb1e7a0e77277cf6dafb1174466dc336d16
    }
}
