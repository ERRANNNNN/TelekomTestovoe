<?php

namespace App\Http\Modules\User;

use App\Http\Modules\User\FormRequests\UserRegisterRequest;
use App\Http\Modules\User\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController
{
    /**
     * Регистрация пользователя
     * @param UserRegisterRequest $request
     * @param UserService $userService
     * @return JsonResponse
     */
    public function register(UserRegisterRequest $request, UserService $userService): JsonResponse
    {
        return response()->json($userService->register($request), 201);
    }
}
