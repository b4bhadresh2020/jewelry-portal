<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Input\InputArgument;

class MakeRepo extends GeneratorCommand
{
    protected $signature  = 'make:repo 
        {name : The required name of the Repository class}
        {--model= : The required name of the model class}';
    protected $description = 'Create a new repository with interface';
    
    public $model = '';

	/**
	 * The type of class being generated.
	 */
    protected $type = 'Repositories';

    /**
     * Replace the class name for the given stub.
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);
        $returnFileData = str_replace('DummyRepository', $this->argument('name'), $stub);
        $returnFileData = str_replace('{{ model }}', $this->model, $stub);
        return $returnFileData;
    }

	/**
	 * Get the stub file for the generator.
	 * @return string
	 */
	protected function getStub()
	{
		return  'stubs/repo.stub';
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace){
		return $rootNamespace . '\Repositories';
	}

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments(){
        return [
            ['name', InputArgument::REQUIRED, 'The name of the repository.'],
        ];
    }

     /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        // $arguments = $this->argument();
        // $arguments = $this->option();
        // $this->model = $this->ask('What is Model name?');
        // Artisan::call('make:repo-interface '.$this->argument('name')."Interface");
       

        if ($this->confirm('Do you wish to continue?'))
        {
            $this->model = $this->option('model');
            
            $progressBar = $this->output->createProgressBar(2);
            $progressBar->start();
            $progressBar->advance();


            if ($this->isReservedName($this->getNameInput())) {
                $this->error('The name "'.$this->getNameInput().'" is reserved by PHP.');
                return false;
            }
    
            $name = $this->qualifyClass($this->getNameInput());
            $path = $this->getPath($name);
    
            if ((! $this->hasOption('force') || ! $this->option('force')) &&
                $this->alreadyExists($this->getNameInput())) {
                $this->error($this->type.' already exists!');
                return false;
            }
            
            $progressBar->advance();
            $this->makeDirectory($path);
            $this->files->put($path, $this->sortImports($this->buildClass($name)));
            $this->call('make:repo-interface', [
                'name'      => $this->argument('name')."Interface",
                '--model'   => $this->model
            ]);
            

            $this->info($this->argument('name').".php");
            $this->info($this->argument('name')."Interface.php");
            $progressBar->finish();
        }
    }
}
