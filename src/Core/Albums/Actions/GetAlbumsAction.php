<?php
namespace Core\Albums\Actions;
use Core\Albums\Domain\SpotifyClientInterface;
use Core\Albums\Domain\Error;

class GetAlbumsAction {
    
    private $client;
    
    public function __construct(SpotifyClientInterface $client)
    {
        $this->client = $client;
    }
    
    public function execute(string $query): array
    {
        if(empty($query)){
            throw new Error('Invalid query', 400);
//             throw new Error('Invalid query', 'DOMAIN_EXCEPTION');
        }
        
        return $this->client->search($query);
    }
}
