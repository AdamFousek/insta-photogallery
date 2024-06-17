<?php

namespace App\Http\Controllers\Api\Validation;

use App\Http\Controllers\Controller;
use App\Queries\User\FindByEmailHandler;
use App\Queries\User\FindByEmailQuery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmailValidation extends Controller
{
    public function __construct(
        private readonly FindByEmailHandler $findByEmailHandler,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $email = $request->get('email', '');

        if ($email === '') {
            return new JsonResponse([
                'message' => trans('Email is required'),
            ], Response::HTTP_BAD_REQUEST);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return new JsonResponse([
                'message' => trans('Invalid email address'),
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = $this->findByEmailHandler->handle(new FindByEmailQuery($email));
        if ($user !== null) {
            return new JsonResponse([
                'message' => 'Email already exists',
            ], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'message' => 'Email is available',
        ], Response::HTTP_OK);
    }
}
