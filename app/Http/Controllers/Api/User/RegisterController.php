<?php

namespace App\Http\Controllers\Api\User;

use App\Commands\User\UserRegistrationCommand;
use App\Commands\User\UserRegistrationHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function __construct(
        private readonly UserRegistrationHandler $userRegistrationHandler,
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $user = $this->userRegistrationHandler->handle(new UserRegistrationCommand(
                $data['email'],
                $data['username'],
                $data['password'],
            ));

            // wip send email to verify

            // set cookied to logged user

            return $this->createResponse([
                'message' => 'User registered successfully',
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage(), ['exception' => $e]);

            return $this->createResponse(
                ['message' => 'Something went wrong'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
