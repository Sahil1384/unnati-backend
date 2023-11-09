<?php

namespace App\Providers\API;

use Illuminate\Support\ServiceProvider;

use App\Services\API\RailwayZoneServices;
use App\Interfaces\API\RailwayZoneServiceInterface;

use App\Interfaces\API\RailwayZoneInterface;
use App\Repository\API\RailwayZoneRepository;

class RailwayZoneServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind(RailwayZoneInterface::Class, RailwayZoneRepository::Class);
        $this->app->bind(RailwayZoneServiceInterface::Class, RailwayZoneServices::Class);
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
