<?php

namespace App\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="InternalServerError",
 *     type="object",
 *     title="InternalServerError",
 * )
 * @OA\Property(
 *     property="message",
 *     type="string"
 * ),
 * @OA\Property(
 *     property="exception",
 *     type="array",
 *     @OA\Items(
 *         @OA\Property(
 *             property="type",
 *             type="string",
 *         ),
 *         @OA\Property(
 *             property="code",
 *             type="integer",
 *         ),
 *         @OA\Property(
 *             property="message",
 *             type="string",
 *         ),
 *         @OA\Property(
 *             property="file",
 *             type="string",
 *         ),
 *         @OA\Property(
 *             property="line",
 *             type="integer",
 *         )
 *     )
 * ),
 *
 */
class InternalServerError
{
}

