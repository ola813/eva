<?php

namespace App\Providers;
use App\Models\Notifcation;
use App\Models\NotifcationFatora;
use View;
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
        View::share('numberAlert',Notifcation::numberAlert());

 
    }
}
