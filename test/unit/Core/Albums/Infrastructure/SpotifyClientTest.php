<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Core\Albums\Domain\Album;

use Core\Albums\Infrastructure\SpotifyClient;

final class SpotifyClientTest extends TestCase
{
    
    public function testCanSearch(): void
    {
        //Given
        $query = 'Cerati';
        $client = new SpotifyClient(getenv('SPOTIFY_CLIENT_ID'), getenv('SPOTIFY_CLIENT_SECRET'));
        
        //When
        $albums = $client->search($query);
        
        //Then
        $this->assertIsArray($albums);
        $album = $albums[0];
        $this->assertInstanceOf(Album::class, $album);
    }
}