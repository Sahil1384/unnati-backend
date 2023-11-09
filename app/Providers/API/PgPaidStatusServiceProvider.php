<?php

namespace App\Providers\API;

use Illuminate\Support\ServiceProvider;

use App\Services\API\PgPaidStatusServices;
use App\Interfaces\API\PgPaidStatusServiceInterface;

use App\Interfaces\API\PgPaidStatusInterface;
use App\Repository\API\PgPaidStatusRepository;

class PgPaidStatusServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind(PgPaidStatusInterface::Class, PgPaidStatusRepository::Class);
        $this->app->bind(PgPaidStatusServiceInterface::Class, PgPaidStatusServices::Class);
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
