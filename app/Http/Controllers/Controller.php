<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Info (
 *  title="Api-work-time-detection documentation",
 *  version="1.0.0"
 * )
 * @OA\Tag(
 *     name="Workers",
 *     description=""
 * )
 * @OA\Server(
 *     description="Localhost",
 *     url="http://127.0.0.1:8000"
 * )
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     name="Authorization",
 *     securityScheme="bearerAuth"
 *
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
