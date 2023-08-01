<?php

namespace Kuroneko\Menu\Providers;

use File;

class MenuServiceProvider extends  \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../../Menu/Routes/web.php');
    }
    public function register()
    {
    }
}
