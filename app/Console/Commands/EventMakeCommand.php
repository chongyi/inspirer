<?php

namespace Inspirer\Console\Commands;

class EventMakeCommand extends \Illuminate\Foundation\Console\EventMakeCommand
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Components\Kernel\Events';
    }

    protected function getStub()
    {
        return app_path('Components/Kernel/Stubs/event.stub');
    }


}
