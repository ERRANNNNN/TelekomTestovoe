<?php

namespace App\Http\Modules\User\Services;

use App\Http\Modules\User\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Регистрация пользователя и генерация токена
     * @param Request $request
     * @return array
     */
    public function register(Request $request): array
    {
        $values = [
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('password'))
        ];

        $user = $this->userRepository->register($values);

        return [
            "token" => $user->createToken('app')->plainTextToken,
            "user" => $user
        ];
    }
}
