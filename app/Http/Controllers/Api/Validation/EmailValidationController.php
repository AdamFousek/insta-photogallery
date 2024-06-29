<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Validation;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class EmailValidationController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users|max:255|email',
        ]);

        if ($validator->fails()) {
            return new JsonResponse([
                'message' => $validator->errors()->first(),
                'error' => true,
            ], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'message' => 'Email is available',
            'error' => false,
        ], Response::HTTP_OK);
    }
}
