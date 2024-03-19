<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once(app_path() . '/Helpers/Common/arrays.php');
        require_once(app_path() . '/Helpers/Common/strings.php');
        require_once(app_path() . '/Helpers/Common/routes.php');
        require_once(app_path() . '/Helpers/Common/traces.php');
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
