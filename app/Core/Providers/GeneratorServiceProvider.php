<?php

namespace ResultSystems\Emtudo\Core\Providers;

use Illuminate\Routing\GeneratorServiceProvider as LaravelGeneratorServiceProvider;
use ResultSystems\Emtudo\Core\Console\ControllerMakeCommand;

class GeneratorServiceProvider extends LaravelGeneratorServiceProvider
{
    protected function registerControllerGenerator()
    {
        $this->app->singleton('command.controller.make', function ($app) {
            return new ControllerMakeCommand($app['files']);
        });
    }
}
