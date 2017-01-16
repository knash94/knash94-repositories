<?php

namespace Knash94\Repositories;

use Illuminate\Support\ServiceProvider;
use Knash94\Repositories\Console\Commands\MakeRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommand();
    }

    private function registerCommand()
    {
        $this->commands(MakeRepository::class);
    }
}
