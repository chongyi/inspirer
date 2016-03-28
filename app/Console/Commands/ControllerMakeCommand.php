<?php

namespace Inspirer\Console\Commands;

use Inspirer\Http\Controllers\Controller;
use Symfony\Component\Console\Input\InputOption;

class ControllerMakeCommand extends \Illuminate\Routing\Console\ControllerMakeCommand
{
    protected $controllers = [
        'c' => Controller::class,
    ];

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('resource')) {
            return app_path('Framework/Kernel/Stubs/controller.stub');
        }

        return app_path('Framework/Kernel/Stubs/controller.plain.stub');
    }

    protected function getOptions()
    {
        return [
            ['resource', 'R', InputOption::VALUE_NONE, 'Generate a resource controller class.'],
            [
                'extends',
                'E',
                InputOption::VALUE_REQUIRED,
                'Select a controller be inherited.',
                Controller::class
            ],
        ];
    }

    public function buildClass($name)
    {
        $stub = parent::buildClass($name);

        $option = $this->option('extends');

        if ($option) {
            if (isset($this->controllers[$option])) {
                $controller = $this->controllers[$option];
            } else {
                $controller = $option;
            }
        } else {
            $controller = Controller::class;
        }

        $stub = str_replace('DummyExtendClassFullName', $controller, $stub);
        $stub = str_replace('DummyExtendClassName', class_basename($controller), $stub);

        return $stub;
    }
}
