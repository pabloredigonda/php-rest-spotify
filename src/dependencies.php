<?php
declare(strict_types=1);

use Delivery\ErrorHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Core\Albums\Actions\GetAlbumsAction;
use Core\Albums\Domain\SpotifyClientInterface;
use Core\Albums\Infrastructure\SpotifyClient;
use Delivery\Enviroment;

$container = [];

$container[Enviroment::class] = function ($c) {
    return new Enviroment();
};

$container[SpotifyClientInterface::class] = function ($c) {
    $enviroment = $c->get(Enviroment::class);
    return new SpotifyClient($enviroment->spotifyClientId(), $enviroment->spotifyClientSecret());
};

$container[GetAlbumsAction::class] = function ($c) {
    return new GetAlbumsAction($c->get(SpotifyClientInterface::class));
};


$container[Logger::class] = function ($c) {
    $enviroment = $c->get(Enviroment::class);
    $logger = new Logger('AppLog');
    $logger->pushProcessor(new UidProcessor());
    $logger->pushHandler(new StreamHandler($enviroment->loggerPath(), Logger::DEBUG));
    return $logger;
};


$container['errorHandler'] = function ($c) {
    $enviroment = $c->get(Enviroment::class);
    return new ErrorHandler($c->get(Logger::class), $enviroment->displayErrorDetails());
};
$container['phpErrorHandler'] = function ($c) {
    return $c->get('errorHandler');
};
$container['notFoundHandler'] = function ($c) {
    return [$c->get('errorHandler'), 'handleNotFound'];
};
$container['notAllowedHandler'] = function ($c) {
    return [$c->get('errorHandler'), 'handleNotAllowed'];
};

return $container;
