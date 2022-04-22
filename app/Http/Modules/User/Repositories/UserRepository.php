<?php

namespace App\Http\Modules\User\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Регистрация пользователя
     * @param array $values
     * @return mixed
     */
    public function register(array $values): User
    {
        return User::create($values);
    }
}
