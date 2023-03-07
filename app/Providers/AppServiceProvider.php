<?php

namespace App\Providers;

use App\Models\Organization;
use App\Models\User;
use App\Observers\OrganizationObserver;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Model;
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
        Model::shouldBeStrict(! $this->app->isProduction());

        User::observe(UserObserver::class);
        Organization::observe(OrganizationObserver::class);
    }
}
