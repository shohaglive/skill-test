<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function __construct(private readonly LoginService $loginService)
    {
    }

    /**
     * Receives login request and responds accordingly
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->loginService->login($request->all());
    }

    /**
     * Accept request and logs a user out
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        return $this->loginService->logout();
    }
}
