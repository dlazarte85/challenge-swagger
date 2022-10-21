<?php

namespace App\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ProductForm",
 *     type="object",
 *     title="ProductForm",
 * )
 * @OA\Property(
 *     property="name",
 *     type="string",
 *     example="Teclado",
 * ),
 * @OA\Property(
 *     property="slug",
 *     type="string",
 *     example="teclado",
 * ),
 * @OA\Property(
 *     property="description",
 *     type="string",
 *     example="Teclado gamer",
 * ),
 * @OA\Property(
 *     property="price",
 *     type="string",
 *     example="13899.99",
 * ),
 * @OA\Property(
 *     property="stock",
 *     type="string",
 *     example="22",
 * ),
 * @OA\Property(
 *     property="keywords",
 *     type="string",
 *     example="teclado,gamer",
 * )
 *
 */
class ProductForm
{
}

