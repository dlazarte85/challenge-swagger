<?php


namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use App\Entities\ProductRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UpdateProductAction extends Action
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
     * @OA\Put(
     *   tags={"products"},
     *   path="/v1/updateProduct/{id}",
     *   summary="Update product",
     *   @OA\Parameter(
     *     in="path",
     *     name="id",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       pattern="[0-9]+"
     *     ),
     *   ),
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
     *     response=200,
     *     description="Successful operation",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="message",
     *           type="string",
     *           example="Product updated succesfully",
     *         )
     *       )
     *     )
     *   )
     * )
     *
     * Update product
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request  RequestInterface
     * @param \Psr\Http\Message\ResponseInterface      $response ResponseInterface
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, $id): Response
    {
        $data = $request->getParsedBody();

        $this->productRepository->update($id, $data);

        $response->getBody()->write(json_encode(['message' => "Product updated succesfully"]));

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
