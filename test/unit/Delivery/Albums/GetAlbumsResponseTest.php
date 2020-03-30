<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Core\Albums\Domain\Album;
use Core\Albums\Domain\Cover;
use Delivery\Albums\GetAlbumsResponse;

final class GetAlbumsResponseTest extends TestCase
{
    
    public function testCanParseAlbum(): void
    {
        //Given
        $now = new DateTimeImmutable();
        $cover = new Cover('example.jpp', 1, 1);
        $album = new Album('Album Name', 20, $now, $cover);
        $albums = [$album];
        $response = new GetAlbumsResponse();
        
        //When
        $parsed = $response->toJson($albums);
        
        //Then
        $this->assertIsArray($parsed);
        $first = $parsed[0];
        $this->assertEquals('Album Name', $first['name']);
        $this->assertEquals(20, $first['tracks']);
        $this->assertEquals($now->format('d-m-Y'), $first['released']);
        $this->assertEquals('example.jpp', $first['cover']['url']);
        $this->assertEquals(1, $first['cover']['width']);
        $this->assertEquals(1, $first['cover']['height']);
    }
}





