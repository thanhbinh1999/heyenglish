<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ViewProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::componentNamespace("views\\components\\contact", "contact");
        Blade::directive('can', function ($value = '') {
            return "<?php echo date('d/m/Y H:i:s');?>";
        });
    }
}
