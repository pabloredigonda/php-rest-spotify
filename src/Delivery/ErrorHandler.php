<?php
declare(strict_types=1);

namespace Delivery;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Core\Albums\Domain\Error as DomainError;
use Throwable;

class ErrorHandler
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var bool
     */
    private $displayErrors;

    /**
    
     * @param LoggerInterface $logger
     * @param bool $displayErrors
     */
    public function __construct(LoggerInterface $logger, bool $displayErrors = false)
    {
        $this->logger = $logger;
        $this->displayErrors = $displayErrors;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param Throwable $exception
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, Throwable $exception): ResponseInterface
    {
        try {
            $request = !empty($request->getParsedBody()) ? $request->getParsedBody() : array();
            $this->logger->error($exception->getMessage(), $request);
        } catch (Exception $e) {
            //
        }
 
        if ($exception instanceof DomainError) {
            return $response->withStatus(400)
                ->withHeader('Content-Type', 'application/json')
                ->withJson(['error' => $exception->code(), 'message' => $exception->message()]);
        }

        return $response->withStatus(404)
            ->withHeader('Content-Type', 'application/json')
            ->withJson(['error' => $this->displayErrors ? $exception->getMessage() : '']);
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function handleNotFound(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $response
            ->withStatus(404)
            ->withHeader('Content-Type', 'application/json');
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function handleNotAllowed(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $response
            ->withStatus(405)
            ->withHeader('Content-Type', 'application/json');
    }
}
