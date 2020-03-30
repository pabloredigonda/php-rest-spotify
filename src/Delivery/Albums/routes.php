<?php 
declare(strict_types=1);

use Core\Albums\Action\GetAlbumsAction;
use Delivery\Albums\GetAlbumsResource;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/api/v1/albums', GetAlbumsResource::class);
$app->get('/', function(){
    die('Hello');
});