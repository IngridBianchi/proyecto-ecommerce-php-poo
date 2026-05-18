<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthService;
use App\Repositories\UserRepository;
use App\Utils\Security;

class UsuarioController
{
    private AuthService $authService;
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->authService = new AuthService($this->userRepository);
    }

    public function registro(): void
    {
        require_once __DIR__ . '/../../templates/usuario/registro.php';
    }

    public function save(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // CSRF Validation
            if (!Security::validateCsrfToken($_POST['csrf_token'] ?? null)) {
                die("CSRF token validation failed.");
            }

            $data = [
                'nombre'    => $_POST['nombre'] ?? '',
                'apellidos' => $_POST['apellidos'] ?? '',
                'email'     => $_POST['email'] ?? '',
                'password'  => $_POST['password'] ?? ''
            ];

            // TODO: Server-side validation (filter_var, etc.)

            if ($this->authService->register($data)) {
                $_SESSION['register'] = "complete";
            } else {
                $_SESSION['register'] = "failed";
            }
        }
        header("Location: /?controller=usuario&action=registro");
        exit();
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // CSRF Validation
            if (!Security::validateCsrfToken($_POST['csrf_token'] ?? null)) {
                die("CSRF token validation failed.");
            }

            $email = $_POST['login_email'] ?? '';
            $password = $_POST['login_password'] ?? '';

            $user = $this->authService->authenticate($email, $password);

            if ($user) {
                $_SESSION['identity'] = $user;
                if ($user->getRol() === 'admin') {
                    $_SESSION['admin'] = true;
                }
                unset($_SESSION['error_login']);
            } else {
                $_SESSION['error_login'] = 'Identificación fallida !!';
            }
        }
        header("Location: index.php");
        exit();
    }

    public function logout(): void
    {
        unset($_SESSION['identity'], $_SESSION['admin']);
        header("Location: index.php");
        exit();
    }
}
