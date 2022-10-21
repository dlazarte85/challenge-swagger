<?php

namespace App\Actions;

use App\Actions\Action;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class WelcomeAction extends Action
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    /**
     * @OA\Get(
     *     path="/",
     *     summary="Message Welcome to Product API",
     *     @OA\Response(
     *         response=200,
     *         description="Welcome to Product API"
     *     ),
     *     @OA\Server(
     *         url="http://localhost:8080",
     *         description="Challenge API server"
     *     )
     * )
     *
     * Returns welcome message
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request  RequestInterface
     * @param \Psr\Http\Message\ResponseInterface      $response ResponseInterface
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        $response->getBody()->write("Welcome to Products API");

        return $response;
    }
}
