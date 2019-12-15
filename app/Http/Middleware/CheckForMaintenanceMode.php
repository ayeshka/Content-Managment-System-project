<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

class CheckForMaintenanceMode extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * This CheckForMaintenance Middlewre is an inbuild middlewre that check if if the application is on the maintanance before handaling any requests.
     * php artisan down -> Put the application into maintenance mode
     * php artisan up -> Bring the application out of maintenance mode
     *
     * What is middleware does before it handles any request it goes ahead on checks application and maintenance mode and
     * if it's in maintenance mode then it is going to prevent the user from visiting that page or using that specific action
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
