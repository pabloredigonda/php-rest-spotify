<?php
namespace Core\Albums\Domain;
use \DateTimeImmutable;

class Album {
    
    private $name;
    private $released;
    private $tracks;
    private $cover;
    
    public function __construct(
        string $name, 
        int $tracks, 
        DateTimeImmutable $released,
        Cover $cover
    ){
        $this->name = $name;
        $this->tracks = $tracks;
        $this->released = $released;
        $this->cover = $cover;
    }
    
    public function getName():string
    {
        return $this->name;
    }
    
    public function getTracks():int
    {
        return $this->tracks;
    }
    
    public function getReleased(): DateTimeImmutable
    {
        return $this->released;
    }
    
    public function getCover(): Cover
    {
        return $this->cover;
    }

}