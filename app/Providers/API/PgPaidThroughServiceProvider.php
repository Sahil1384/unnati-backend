<?php

namespace App\Providers\API;

use Illuminate\Support\ServiceProvider;

use App\Services\API\PgPaidThroughServices;
use App\Interfaces\API\PgPaidThroughServiceInterface;

use App\Interfaces\API\PgPaidThroughInterface;
use App\Repository\API\PgPaidThroughRepository;

class PgPaidThroughServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind(PgPaidThroughInterface::Class, PgPaidThroughRepository::Class);
        $this->app->bind(PgPaidThroughServiceInterface::Class, PgPaidThroughServices::Class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
