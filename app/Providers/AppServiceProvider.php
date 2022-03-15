<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extendImplicit('allowed_attributes', function ($attribute, $value, $parameters) {
            // If the attribute to validate request top level
            if (strpos($attribute, '.') === false) {
                return in_array($attribute, $parameters);
            }

            // If the attribute under validation is an array
            if (is_array($value)) {
                return empty(array_diff_key($value, array_flip($parameters)));
            }

            // If the attribute under validation is an object
            foreach ($parameters as $parameter) {
                if (substr_compare($attribute, $parameter, -strlen($parameter)) === 0) {
                    return true;
                }
            }

            return false;
        });
    }
}
