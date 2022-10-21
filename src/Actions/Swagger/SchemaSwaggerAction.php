<?php

namespace App\Actions\Swagger;

use App\Actions\Action;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class SchemaSwaggerAction extends Action
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    /**
     * Returns swagger schema
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request  RequestInterface
     * @param \Psr\Http\Message\ResponseInterface      $response ResponseInterface
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        $newResponse = $response->withHeader('Content-Type', 'application/x-yaml');
        $newResponse->getBody()->write(file_get_contents(PUBLIC_PATH . '/openapi.yaml'));

        return $newResponse;
    }
}
