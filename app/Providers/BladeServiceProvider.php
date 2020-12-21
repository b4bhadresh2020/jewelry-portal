<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
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
        Blade::directive('__permission', function ($expression) {
            $permissions    = bladeDirectiveSeparator($expression);
            $hasPermission  = (isDeveloper() || Auth::user()->syncPermissions($permissions)) ? true : false;
            return "<?php if ({$hasPermission}) { ?>";
        });

        Blade::directive('elseif__permission', function ($expression) {
            $permissions    = bladeDirectiveSeparator($expression);
            $hasPermission  = (isDeveloper() || Auth::user()->syncPermissions($permissions)) ? true : false;
            return "<?php else if ({$hasPermission}) { ?>";
        });

        Blade::directive('else__permission', function () {
            return "<?php } else { ?>";
        });

        Blade::directive('end__permission', function () {
            return "<?php } ?>";
        });

        Blade::directive('developer', function () {
            $isDeveloper  = isDeveloper();
            return "<?php if ({$isDeveloper}) { ?>";
        });

        Blade::directive('elsedeveloper', function () {
            return "<?php } else { ?>";
        });

        Blade::directive('enddeveloper', function () {
            return "<?php } ?>";
        });
    }
}
