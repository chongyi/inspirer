<?php

namespace Inspirer\Console\Commands;

class JobMakeCommand extends \Illuminate\Foundation\Console\JobMakeCommand
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Framework\Kernel\Jobs';
    }

    protected function getStub()
    {
        if ($this->option('sync')) {
            return app_path('Framework/Kernel/Stubs/job.stub');
        } else {
            return app_path('Framework/Kernel/Stubs/job-queued.stub');
        }
    }
}
