<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    /**
     * @param array $data
     * @param int $status
     * @param array $headers
     * @return JsonResponse
     */
    protected function createResponse(
        array $data = [],
        int $status = Response::HTTP_OK,
        array $headers = []
    ): JsonResponse
    {
        $defaultData = [
            'error' => !in_array($status, [Response::HTTP_OK, Response::HTTP_ACCEPTED], true),
        ];


        return new JsonResponse(
            $defaultData + $data,
            $status,
            $headers,
        );
    }
}
