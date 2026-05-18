<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class AuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authenticate(string $email, string $password): ?User
    {
        $email = trim(strtolower($email));
        $password = trim($password);
        $user = $this->userRepository->findByEmail($email);
        
        if ($user && password_verify($password, $user->getPassword())) {
            return $user;
        }

        return null;
    }

    public function register(array $data): bool
    {
        $user = new User();
        $user->setNombre($data['nombre'])
             ->setApellidos($data['apellidos'])
             ->setEmail($data['email'])
             ->setPassword($data['password']); // Hashing is handled by Repository in this simple approach

        return $this->userRepository->save($user);
    }
}
