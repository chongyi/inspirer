<?php

namespace Inspirer\Console\Commands;

class JobMakeCommand extends \Illuminate\Foundation\Console\JobMakeCommand
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Components\Kernel\Jobs';
    }

    protected function getStub()
    {
        if ($this->option('sync')) {
            return app_path('Components/Kernel/Stubs/job.stub');
        } else {
            return app_path('Components/Kernel/Stubs/job-queued.stub');
        }
    }
}
