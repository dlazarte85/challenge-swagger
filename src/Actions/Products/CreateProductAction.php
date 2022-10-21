<?php


namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use App\Entities\ProductRepository;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CreateProductAction extends Action
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
     *   path="/v1/createProduct",
     *   summary="Create product",
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="name",
     *           type="string",
     *         ),
     *         @OA\Property(
     *           property="slug",
     *           type="string",
     *         ),
     *         @OA\Property(
     *           property="description",
     *           type="string"
     *         ),
     *         @OA\Property(
     *           property="price",
     *           type="integer"
     *         ),
     *         @OA\Property(
     *           property="stock",
     *           type="integer"
     *         ),
     *         @OA\Property(
     *           property="keywords",
     *           type="string"
     *         ),
     *         example={"name": "Monitor", "slug": "monitor", "description": "Monitor 20' pulgadas", "price": 45499.99, "stock": 13, "keywords": "monitor"}
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Successful operation",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="message",
     *           type="string",
     *           example="Product created succesfully",
     *         )
     *       )
     *     )
     *   )
     * )
     *
     * Create product
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request  RequestInterface
     * @param \Psr\Http\Message\ResponseInterface      $response ResponseInterface
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $this->productRepository->create($data);

        $response->getBody()->write(json_encode(['message' => "Product created succesfully"]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(StatusCodeInterface::STATUS_CREATED);
    }
}
