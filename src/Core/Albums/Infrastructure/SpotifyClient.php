<?php 
namespace Core\Albums\Infrastructure;
use Core\Albums\Domain\SpotifyClientInterface;
use GuzzleHttp\Client;

class SpotifyClient implements SpotifyClientInterface {
    
    private string $clientId;
    private string $clientSecret;
    private string $token;
    
    public function __construct(string $clientId, string $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->token = '';
    }
    
    
    private function getToken(): string
    {
        if(!$this->token){
            $this->token = $this->createToken();
        }
        
        return $this->token;
    }
    
    private function createToken(): string
    {
        $client = new Client([
            'base_uri' => 'https://accounts.spotify.com',
            'timeout'  => 2.0,
        ]);
        
        $response = $client->request(
            'POST', 
            '/api/token?grant_type=client_credentials', 
            [
                'headers' => ['Content-Type' => 'application/x-www-form-urlencoded' ],
                'auth' => [$this->clientId, $this->clientSecret]
            ]
        );
        
        $body = json_decode($response->getBody(), true);
        return $body['access_token'];
    }
    
    private function doSearch(string $query): array
    {
        $token = $this->getToken();
        $client = new Client([
            'base_uri' => 'https://api.spotify.com',
            'timeout'  => 2.0,
        ]);
        
        $limit = 20;
        $offset = 0;
        $items = [];
        while(true){
            $response = $client->request('GET', '/v1/search',[
                'query' => [
                    'type' => 'album', 
                    'limit'=> $limit, 
                    'offset'=> $offset,
                    'q' => "artist:{$query}"],
                'headers' => ['Authorization' => "Bearer {$token}"]
            ]);
            $results = json_decode($response->getBody(), true);
            $items = array_merge($items, $results['albums']['items']);
            $offset+=$limit;
            
            if(!$results['albums']['next']){
                break;
            }
        }
        
        return $items;
    }
    
    public function search(string $query): array
    {
        $items = $this->doSearch($query);
        $parser = new AlbumParser();
        $albums = [];
        
        foreach ($items as $item){
            $albums[] = $parser->parse($item);
        }
        
        return $albums;
    }
}