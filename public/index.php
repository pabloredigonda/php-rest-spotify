<?php
require __DIR__ . '/../vendor/autoload.php';
use Delivery\Application;

$envPath = '/var/www/html/src/';
$dependencies = __DIR__ . '/../src/dependencies.php';

$app = new Application($envPath, $dependencies);

// Register routes
require __DIR__ . '/../src/Delivery/Albums/routes.php';

// Run app
$app->run();
