<?php

namespace Inspirer\Console\Commands;

class PolicyMakeCommand extends \Illuminate\Foundation\Console\PolicyMakeCommand
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Framework\Account\Authentication\Policies';
    }

}
