<?php

namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetProductByIdAction extends Action
{
    protected $productRepository;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        /**
         * @var \App\Entities\ProductRepository
         */
        $this->productRepository = $this->entityManager
            ->getRepository(Product::class);
    }

    /**
     * @OA\Get(
     *     tags={"products"},
     *     path="/products/{id}",
     *     summary="Get Product by Id",
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="Numeric ID of the product to get",
     *         @OA\Schema(
     *             type="integer",
     *             pattern="[0-9]+"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 ref="#/components/schemas/Product"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                ref="#/components/schemas/InternalServerError"
     *             )
     *         )
     *     )
     * )
     *
     * Get product by id
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request  RequestInterface
     * @param \Psr\Http\Message\ResponseInterface      $response ResponseInterface
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, int $id = null): Response
    {
        /**
         * Product domain
         *
         * @var \App\Entities\Product
         */
        $product = $this->productRepository->getById($id);

        $response->getBody()->write($product->toJSON());
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
