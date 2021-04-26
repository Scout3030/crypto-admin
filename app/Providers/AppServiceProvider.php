<?php

namespace App\Providers;

use App\Helpers\Services\PermissionsHelper;
use App\Helpers\Services\SegmentService;
use App\Services\NotificationService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
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

        if (config('app.force_https')) {
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(NotificationService $notificationService)
    {
        if (config('app.force_https')) {
            URL::forceScheme('https');
        }

        Paginator::defaultView('vendor.pagination.bootstrap-4');
        View::composer('layouts.main', function ($view) use ($notificationService) {
            $user = Auth::user();

            $view->with('notifications', $notificationService->getLatest($user));
        });
    }
}
