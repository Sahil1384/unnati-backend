<?php

namespace App\Providers\API;

use Illuminate\Support\ServiceProvider;

use App\Services\API\SdPaidThroughServices;
use App\Interfaces\API\SdPaidThroughServiceInterface;

use App\Interfaces\API\SdPaidThroughInterface;
use App\Repository\API\SdPaidThroughRepository;

class SdPaidThroughServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind(SdPaidThroughInterface::Class, SdPaidThroughRepository::Class);
        $this->app->bind(SdPaidThroughServiceInterface::Class, SdPaidThroughServices::Class);
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
