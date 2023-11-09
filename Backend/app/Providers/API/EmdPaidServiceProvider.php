<?php

namespace App\Providers\API;

use Illuminate\Support\ServiceProvider;

use App\Services\API\EmdPaidServices;
use App\Interfaces\API\EmdPaidServiceInterface;

use App\Interfaces\API\EmdPaidInterface;
use App\Repository\API\EmdPaidRepository;

class EmdPaidServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind(EmdPaidInterface::Class, EmdPaidRepository::Class);
        $this->app->bind(EmdPaidServiceInterface::Class, EmdPaidServices::Class);
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
