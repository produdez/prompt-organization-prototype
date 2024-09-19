<?php

namespace App\Providers\Helpers;

use Illuminate\Support\ServiceProvider;

class HelpersProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadHelpers();
    }

    protected function loadHelpers()
    {
        $helpersFile = 'App/Providers/Helpers/helpers.php';

        if (file_exists($helpersFile)) {
            require_once $helpersFile;
        }
    }
}
