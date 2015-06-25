<?php

namespace ResultSystems\Emtudo\Core\Console;

use Illuminate\Routing\Console\ControllerMakeCommand as LaravelControllerMakeCommand;

class ControllerMakeCommand extends LaravelControllerMakeCommand
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

}
