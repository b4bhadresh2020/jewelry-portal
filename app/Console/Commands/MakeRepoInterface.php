<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Input\InputArgument;

class MakeRepoInterface extends GeneratorCommand
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'make:repo-interface
		{name : The required name of the Repository class}
        {--model= : The required name of the model class}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new repository with interface';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Repositories';

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);
		return str_replace('DummyRepository', $this->argument('name'), $stub);
        $returnFileData = str_replace('{{ model }}', $this->option('model'), $stub);
        return $returnFileData;
    }

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return  'stubs/repo-interface.stub';
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Repositories';
	}

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the repository.'],
        ];
    }


}
