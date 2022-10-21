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
     *     tags={"products"},
     *     path="/updateProduct/{id}",
     *     summary="Update product",
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="Numeric ID of the product to update",
     *         @OA\Schema(
     *             type="integer",
     *             pattern="[0-9]+"
     *         ),
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 ref="#/components/schemas/ProductForm"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                     example="Product updated succesfully",
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
