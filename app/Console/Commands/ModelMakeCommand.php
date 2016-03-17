<?php

namespace Inspirer\Console\Commands;

class ModelMakeCommand extends \Illuminate\Foundation\Console\ModelMakeCommand
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Components';
    }
}
