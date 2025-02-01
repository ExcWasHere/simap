<?php

namespace App\Providers;

use App\Models\Intelijen;
use App\Observers\IntelijenObserver;
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
        Intelijen::observe(IntelijenObserver::class);
    }
}