<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

final class SearchAlbumsTest extends TestCase
{
    public function testCanSearch(): void
    {
        //Given
        $query = 'Cerati';
        
        //When
        $response = $this->search($query);
        $body = (string) $response->getBody();
        $albums = json_decode($body, true);
        
        //Then
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsArray($albums);
        $first = $albums[0];
        $this->assertArrayHasKey('name', $first);
        $this->assertArrayHasKey('released', $first);
        $this->assertArrayHasKey('tracks', $first);
        $this->assertArrayHasKey('cover', $first);
        $this->assertArrayHasKey('url', $first['cover']);
        $this->assertArrayHasKey('width', $first['cover']);
        $this->assertArrayHasKey('height', $first['cover']);
    }
    
    public function testCannotSearchWithInvalidQuery(): void
    {
        //Given
        $query = '';
        
        //When
        $response = $this->search($query);
        $body = (string) $response->getBody();
        $json = json_decode($body, true);
        
        //Then
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertArrayHasKey('error', $json);
        $this->assertArrayHasKey('message', $json);
        $this->assertEquals("DOMAIN_EXCEPTION", $json['error']);
        $this->assertEquals("Invalid Query", $json['message']);
    }
    
    private function search(string $query)
    {
        $client = new Client([
            'base_uri' => 'http://php-rest-spotify-nginx-container/',
            'timeout'  => 2.0,
        ]);
        
        return $client->request('GET', '/api/v1/albums',[
            'query' => ['q' => $query],
            'http_errors' => false
        ]);
    }
    
}