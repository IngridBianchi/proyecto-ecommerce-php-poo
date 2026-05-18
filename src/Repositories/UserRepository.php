<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Config\Database;
use App\Models\User;
use PDO;

class UserRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function save(User $user): bool
    {
        $sql = "INSERT INTO usuarios (nombre, apellidos, email, password, rol) VALUES (:nombre, :apellidos, :email, :password, :rol)";
        $stmt = $this->db->prepare($sql);
        
        // Use modern password hashing
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        return $stmt->execute([
            ':nombre'    => $user->getNombre(),
            ':apellidos' => $user->getApellidos(),
            ':email'     => $user->getEmail(),
            ':password'  => $hashedPassword,
            ':rol'       => $user->getRol()
        ]);
    }

    public function findByEmail(string $email): ?User
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        
        $userData = $stmt->fetch();
        if (!$userData) {
            return null;
        }

        return $this->mapToModel($userData);
    }

    private function mapToModel($data): User
    {
        $user = new User();
        $user->setId((int)$data->id)
             ->setNombre($data->nombre)
             ->setApellidos($data->apellidos)
             ->setEmail($data->email)
             ->setPassword($data->password)
             ->setRol($data->rol)
             ->setImagen($data->imagen);
        return $user;
    }
}
