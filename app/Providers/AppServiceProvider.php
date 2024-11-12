<?php

namespace App\Providers;


use Illuminate\Support\Facades\View;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
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
        $websiteSetting = Setting::first();
        Paginator::useBootstrapFive();
        view::share('appSetting', $websiteSetting);
    }
}
