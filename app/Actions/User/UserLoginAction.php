<?php

namespace App\Actions\User;

use App\Repositories\User\UserInterfaceRepository;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class UserLoginAction
{
    public function __construct(
        private readonly UserInterfaceRepository $userInterfaceRepository
    ) {
    }

    public function execute(string $email, string $password): string
    {
        $user = $this->userInterfaceRepository->findByEmail($email);
        
        if (is_null($user) || !Hash::check($password, $user->password)) {
            throw new UnauthorizedHttpException('', 'Invalid credentials');
        }

        return $user->createToken('auth-token')->plainTextToken;
    }
}
