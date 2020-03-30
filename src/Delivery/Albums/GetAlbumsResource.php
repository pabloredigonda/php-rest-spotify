<?php
namespace Delivery\Albums;
use Core\Albums\Actions\GetAlbumsAction;
use Slim\Http\Request;
use Slim\Http\Response;

class GetAlbumsResource {
    
    private GetAlbumsAction $action; 
     
    public function __construct(GetAlbumsAction $action)
    {
        $this->action = $action;
    }
    
    public function __invoke(Request $request, Response $response)
    {
        $query = $request->getParam('q', '');
        $albums = $this->action->execute($query);
        
        $formater =  new GetAlbumsResponse();
        
        return $response->withJson(
            $formater->toJson($albums)
        );
    }
    
}