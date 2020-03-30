<?php 
namespace Core\Albums\Domain;

class Error extends \Exception
{
    public final function code():string
    {
        return 'DOMAIN_EXCEPTION';
    }
    
    public final function message():string
    {
        return 'Invalid Query';
    }
}