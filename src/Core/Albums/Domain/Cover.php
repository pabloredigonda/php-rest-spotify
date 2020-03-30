<?php
namespace Core\Albums\Domain;

class Cover {
    
    private $height;
    private $width;
    private $url;
    
    public function __construct(string $url, int $width, int $height)
    {
        $this->url = $url;
        $this->width = $width;
        $this->height = $height;
    }
    
    public function getUrl():string
    {
        return $this->url;
    }
    
    public function getWidth():int
    {
        return $this->width;
    }
    
    public function getHeight():int
    {
        return $this->height;
    }
    
}