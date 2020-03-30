<?php 
namespace Core\Albums\Domain;

interface SpotifyClientInterface {
    
    public function search(string $query);
    
}
