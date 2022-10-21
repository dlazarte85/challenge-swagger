<?php

namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetProductBySlugAction extends Action
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
     *   tags={"products"},
     *   path="/v1/products/{slug}",
     *   summary="Get Product by Slug",
     *   @OA\Parameter(
     *     in="path",
     *     name="slug",
     *     required=true,
     *     @OA\Schema(
     *       type="string",
     *       pattern="[0-9-a-zA-Z]+"
     *     ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         ref="#/components/schemas/Product"
     *       )
     *     )
     *   )
     * )
     *
     * Get product by slug
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request  RequestInterface
     * @param \Psr\Http\Message\ResponseInterface      $response ResponseInterface
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, $slug): Response
    {
        /**
         * Product domain
         *
         * @var \App\Entities\Product
         */
        $product = $this->productRepository->getBySlug($slug);

        $response->getBody()->write($product->toJSON());

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
