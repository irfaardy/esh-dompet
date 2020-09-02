<?php

namespace Irfa\Dompet;

use Illuminate\Support\ServiceProvider;
use Artisan;

class DompetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    protected $commands = [];

    public function register()
    {


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../resources/migrations' => database_path('migrations'),
            __DIR__.'/../resources/lang' => resource_path('lang')], 'dompet');

    }
}
