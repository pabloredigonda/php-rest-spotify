<?php 
namespace Core\Albums\Infrastructure;
use Core\Albums\Domain\Cover;
use Core\Albums\Domain\Album;
use \DateTimeImmutable;

class AlbumParser  {
    
    public function parse( $item ): Album{
        $cover = $this->getCover($item);
        $released = new DateTimeImmutable($item['release_date']);
        return new Album($item['name'], $item['total_tracks'], $released, $cover);
    }
    
    private function getCover( $item ): Cover
    {
        $first = $item['images'][0];
        return new Cover($first['url'], $first['width'], $first['height']);
    }
}