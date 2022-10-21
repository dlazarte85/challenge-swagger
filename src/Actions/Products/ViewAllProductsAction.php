<?php

namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class ViewAllProductsAction extends Action
{
    /**
     * Product repository
     *
     * @var \App\Entities\ProductRepository
     */
    protected $productRepository;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->productRepository = $this->entityManager
            ->getRepository(Product::class);
    }

    /**
     * @OA\Get(
     *     tags={"products"},
     *     path="/products",
     *     summary="List all Products",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(
     *                     ref="#/components/schemas/Product"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 ref="#/components/schemas/InternalServerError"
     *             )
     *         )
     *     )
     * )
     *
     * Fetch all products and returns response
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request  RequestInterface
     * @param \Psr\Http\Message\ResponseInterface      $response ResponseInterface
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $products = $this->productRepository->fetchAll();

        $response->getBody()->write(json_encode($products));

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
