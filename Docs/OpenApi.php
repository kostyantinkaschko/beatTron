<?php

namespace Docs;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="BeatTronAPI",
 *     version="1.0.0",
 *     description="Operations with songs"
 * )
 *
 * 
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Server"
 * )
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat=""
 *)
 */
class OpenApi {}
