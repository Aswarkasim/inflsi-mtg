<?php

namespace App\Providers;

use App\Models\Configuration;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class GeneralProvider extends ServiceProvider
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
        //
        $config = Configuration::first();
        $notif = \App\Models\Saran::where('is_read', 0)->count();
        View::share('config_provider', $config);
        View::share('notif_provider', $notif);
    }
}
