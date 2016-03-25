<?php

namespace Inspirer\Console\Commands;

class ProviderMakeCommand extends \Illuminate\Foundation\Console\ProviderMakeCommand
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Framework\Kernel\Providers';
    }
}
