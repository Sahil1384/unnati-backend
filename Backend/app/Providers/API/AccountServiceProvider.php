<?php

namespace App\Providers\API;

use Illuminate\Support\ServiceProvider;

use App\Services\API\AccountServices;
use App\Interfaces\API\AccountServiceInterface;

use App\Interfaces\API\AccountInterface;
use App\Repository\API\AccountRepository;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind(AccountInterface::Class, AccountRepository::Class);
        $this->app->bind(AccountServiceInterface::Class, AccountServices::Class);
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
