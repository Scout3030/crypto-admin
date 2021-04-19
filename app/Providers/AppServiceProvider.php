<?php

namespace App\Providers;

use App\Helpers\Services\PermissionsHelper;
use App\Helpers\Services\SegmentService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PermissionsHelper::class, function () {
            return new PermissionsHelper();
        });

        $this->app->singleton(SegmentService::class, function () {
            return new SegmentService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        URL::forceScheme('https');

        Paginator::defaultView('vendor.pagination.bootstrap-4');
    }
}
