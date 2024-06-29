<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Validation;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class UsernameValidationController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users|min:4|max:255|alpha_num',
        ]);

        if ($validator->fails()) {
            return new JsonResponse([
                'message' => $validator->errors()->first(),
                'error' => true,
            ], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'message' => 'Username is available',
            'error' => false,
        ], Response::HTTP_OK);
    }
}
