<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Core\Albums\Domain\Album;
use Core\Albums\Domain\Cover;
use Core\Albums\Infrastructure\AlbumParser;

final class AlbumParserTest extends TestCase
{
    
    public function testCanParseAlbum(): void
    {
        //Given
        $item = [
            "images" => [
                [
                    "height" => 640,
                    "url" => "https://i.scdn.co/image/ab67616d0000b27332ba22ba4df6a89bb6bfe3cf",
                    "width" => 640
                ],
                [
                    "height" => 300,
                    "url" => "https://i.scdn.co/image/ab67616d00001e0232ba22ba4df6a89bb6bfe3cf",
                    "width" => 300
                ]
            ],
            "name" => "Certified Hitmaker",
            "release_date" => "2019-11-08",
            "release_date_precision" => "day",
            "total_tracks" => 14,
            "type" => "album",
        ];
        $parser = new AlbumParser();
        
        //When
        $album = $parser->parse($item);
        
        //Then
        $this->assertInstanceOf(Album::class, $album);
        $this->assertEquals('Certified Hitmaker', $album->getName());
        $this->assertEquals(14, $album->getTracks());
        $this->assertInstanceOf(DateTimeImmutable::class, $album->getReleased());
        $this->assertEquals('2019-11-08', $album->getReleased()->format('Y-m-d'));
        $this->assertInstanceOf(Cover::class, $album->getCover());
        $this->assertEquals('https://i.scdn.co/image/ab67616d0000b27332ba22ba4df6a89bb6bfe3cf', $album->getCover()->getUrl());
        $this->assertEquals(640, $album->getCover()->getWidth());
        $this->assertEquals(640, $album->getCover()->getHeight());
    }
}





