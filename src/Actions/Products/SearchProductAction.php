<?php

namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use App\Entities\ProductRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SearchProductAction extends Action
{
    protected $productRepository;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        /**
         * @var ProductRepository
         */
        $this->productRepository = $this->entityManager
            ->getRepository(Product::class);
    }


    /**
     * @OA\Post(
     *   tags={"products"},
     *   path="/v1/products/search",
     *   summary="Search product",
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="name",
     *           type="string",
     *         ),
     *         @OA\Property(
     *           property="keywords",
     *           type="string"
     *         ),
     *         example={"name": "Monitor", "keywords": "monitor"}
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         type="array",
     *         @OA\Items(
     *           ref="#/components/schemas/Product"
     *         )
     *       )
     *     )
     *   )
     * )
     *
     * Search products
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request  RequestInterface
     * @param \Psr\Http\Message\ResponseInterface      $response ResponseInterface
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $products = $this->productRepository->getByQuery($data);

        $response->getBody()->write(json_encode($products));

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
