<?php

namespace App\Providers;

use App\Helpers\Services\PermissionsHelper;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //if (env('APP_ENV') !== 'local') {
        URL::forceScheme('https');
       // }

        Paginator::defaultView('vendor.pagination.bootstrap-4');
    }
}
