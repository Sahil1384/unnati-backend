<?php

namespace App\Providers\API;

use Illuminate\Support\ServiceProvider;

use App\Services\API\UnitServices;
use App\Interfaces\API\UnitServiceInterface;

use App\Interfaces\API\UnitInterface;
use App\Repository\API\UnitRepository;

class UnitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind(UnitInterface::Class, UnitRepository::Class);
        $this->app->bind(UnitServiceInterface::Class, UnitServices::Class);
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
