<?php

namespace Knash94\Repositories\Console\Commands;

use InvalidArgumentException;
use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class MakeRepository extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name : The name of the repository} {--with-cache : Whether to use the cache repository or else just use the eloquent repository}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository';

    protected $type = 'Repository';

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return trim($this->argument('name'));
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Repositories';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('with-cache')){
            return __DIR__ . '/Template/CacheRepositoryTemplate.stub';
        }
        return __DIR__ . '/Template/EloquentRepositoryTemplate.stub';
    }



}
