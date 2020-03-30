<?php
namespace Delivery\Albums;
use Core\Albums\Domain\Album;
use Core\Albums\Domain\Cover;

class GetAlbumsResponse {
    
    public function toJson(array $albums)
    {
        return array_map(fn (Album $album) => $this->formatAlbum($album), $albums);
    }
    
    private function formatAlbum(Album $album): array
    {
        return [
            'name'      => $album->getName(),
            'tracks'    => $album->getTracks(),
            'released'  => $album->getReleased()->format('d-m-Y'),
            'cover'     => $this->formatCover($album->getCover())
        ];
    }
    
    private function formatCover(Cover $cover): array
    {
        return [
            'url'   => $cover->getUrl(),
            'width' => $cover->getWidth(),
            'height'=> $cover->getHeight(),
        ];
    }
    
}