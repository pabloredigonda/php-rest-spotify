<?php
declare(strict_types=1);
namespace Delivery;

class Enviroment 
{
    public function spotifyClientId():string
    {
        return getenv('SPOTIFY_CLIENT_ID');
    }
    
    public function spotifyClientSecret():string
    {
        return getenv('SPOTIFY_CLIENT_SECRET');
    }
    
    public function loggerPath():string
    {
        return getenv('LOGS_PATH'). '/app.log';
    }
    
    public function displayErrorDetails():bool
    {
        return getenv('ENVIRONMENT') != 'production';
    }
    
}
