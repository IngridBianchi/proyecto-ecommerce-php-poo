<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Config\Database;
use App\Models\Category;
use PDO;

class CategoryRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM categorias ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?Category
    {
        $sql = "SELECT * FROM categorias WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch();

        return $data ? $this->mapToModel($data) : null;
    }

    public function save(Category $category): bool
    {
        $sql = "INSERT INTO categorias (nombre) VALUES (:nombre)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':nombre' => $category->getNombre()]);
    }

    private function mapToModel($data): Category
    {
        $category = new Category();
        $category->setId((int)$data->id)
                 ->setNombre($data->nombre);
        return $category;
    }
}
