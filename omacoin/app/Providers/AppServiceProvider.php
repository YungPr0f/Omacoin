<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
        //
        Validator::extend('unique_wallet_store', function($attribute, $value, $parameters, $validator) {
            return DB::table($parameters[0])
                ->where('network', $parameters[1])
                ->where('currency', $parameters[2])
                ->where('platform', $parameters[3])
                ->where('address', $value)
                ->count() < 1;
        });

        Validator::extend('unique_wallet_update', function($attribute, $value, $parameters, $validator) {
            return DB::table($parameters[0])
                ->where('network', $parameters[1])
                ->where('currency', $parameters[2])
                ->where('platform', $parameters[3])
                ->where('id', '!=', $parameters[4])
                ->where('address', $value)
                ->count() < 1;
        });



        Validator::extend('no_network_store', function($attribute, $value, $parameters, $validator) {
            return DB::table($parameters[0])
                ->where('currency', $value)
                ->whereNull('network')
                ->count() < 1;
        });

        Validator::extend('no_network_update', function($attribute, $value, $parameters, $validator) {
            return DB::table($parameters[0])
                ->where('id', '!=', $parameters[1])
                ->where('currency', $value)
                ->whereNull('network')
                ->count() < 1;
        });
    }
}
