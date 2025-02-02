<?php

namespace App\Providers;

use App\Models\Intelijen as IntelijenModel;
use App\Observers\Intelijen;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        IntelijenModel::observe(Intelijen::class);
    }
}