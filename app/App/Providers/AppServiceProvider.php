<?php

namespace DDD\App\Providers;

use DDD\Domain\Base\Organizations\Organization;
// Vendors
use Illuminate\Support\ServiceProvider;
// Domains
use Laravel\Cashier\Cashier;

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
        Cashier::useCustomerModel(Organization::class);
    }
}
