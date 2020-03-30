<?php
declare(strict_types=1);

namespace Delivery;
use DI\Bridge\Slim\App;
use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;
use DI\ContainerBuilder;

class Application extends App
{
    private string $dependencies;
    
    public function __construct(string $envPath, string $dependencies )
    {
        $this->dependencies = $dependencies;
        $this->loadEnviroment($envPath);
        parent::__construct();
    }
    
    protected function configureContainer(ContainerBuilder $builder): void
    {
        $builder->addDefinitions($this->dependencies);
    }
    
    private function loadEnviroment(string $envPath): void
    {
        try {
            $env = new Dotenv($envPath);
            $env->load();
        } catch (InvalidPathException $e) {
            die('.env file not found!');
        }
    }
}
