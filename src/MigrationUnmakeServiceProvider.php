<?php

namespace BCleverly\MigrationUnmake;

use BCleverly\MigrationUnmake\Console\Commands\UnmakeMigration;
use Illuminate\Support\ServiceProvider;

class MigrationUnmakeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                UnmakeMigration::class
            ]);
        }
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
