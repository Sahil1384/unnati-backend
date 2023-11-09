<?php

namespace App\Providers\API;

use Illuminate\Support\ServiceProvider;

use App\Services\API\SdPaidStatusServices;
use App\Interfaces\API\SdPaidStatusServiceInterface;

use App\Interfaces\API\SdPaidStatusInterface;
use App\Repository\API\SdPaidStatusRepository;

class SdPaidStatusServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind(SdPaidStatusInterface::Class, SdPaidStatusRepository::Class);
        $this->app->bind(SdPaidStatusServiceInterface::Class, SdPaidStatusServices::Class);
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
