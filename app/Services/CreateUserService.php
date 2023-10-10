<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\User;

class CreateUserService {
    public function execute(array $data) {
        $userFound = User::firstWhere('email', $data['email']);
        $cpfFound = User::firstWhere('cpf', $data['cpf']);

        if (!is_null($userFound)) {
            throw new AppError("Email já cadastrado!", 400);
        }
        if (!is_null($cpfFound)) {
            throw new AppError("CPF já cadastrado!", 400);
        }

        return User::create($data);
    }
};
