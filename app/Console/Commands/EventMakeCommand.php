<?php

namespace Inspirer\Console\Commands;

class EventMakeCommand extends \Illuminate\Foundation\Console\EventMakeCommand
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Framework\Kernel\Events';
    }

    protected function getStub()
    {
        return app_path('Framework/Kernel/Stubs/event.stub');
    }


}
