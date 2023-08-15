<?php

namespace App\Repositories\User;

use App\Models\User;

class UserEloquentRepository implements UserInterfaceRepository
{
    public function __construct(
        private readonly User $model,
    ) {
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model->firstWhere('email', $email);
    }
}
