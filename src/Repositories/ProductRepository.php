<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Config\Database;
use App\Models\Product;
use PDO;

class ProductRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM productos ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?Product
    {
        $sql = "SELECT * FROM productos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch();

        return $data ? $this->mapToModel($data) : null;
    }

    public function findByCategory(int $categoryId): array
    {
        $sql = "SELECT p.*, c.nombre AS catnombre FROM productos p "
             . "INNER JOIN categorias c ON c.id = p.categoria_id "
             . "WHERE p.categoria_id = :category_id ORDER BY p.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':category_id' => $categoryId]);
        return $stmt->fetchAll();
    }

    public function getRandom(int $limit): array
    {
        $sql = "SELECT * FROM productos ORDER BY RAND() LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function save(Product $product): bool
    {
        if ($product->getId()) {
            return $this->update($product);
        }

        $sql = "INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, fecha, imagen) "
             . "VALUES (:categoria_id, :nombre, :descripcion, :precio, :stock, CURDATE(), :imagen)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':categoria_id' => $product->getCategoriaId(),
            ':nombre'       => $product->getNombre(),
            ':descripcion'  => $product->getDescripcion(),
            ':precio'       => $product->getPrecio(),
            ':stock'        => $product->getStock(),
            ':imagen'       => $product->getImagen(),
        ]);
    }

    private function update(Product $product): bool
    {
        $sql = "UPDATE productos SET categoria_id = :categoria_id, nombre = :nombre, "
             . "descripcion = :descripcion, precio = :precio, stock = :stock ";
        
        $params = [
            ':categoria_id' => $product->getCategoriaId(),
            ':nombre'       => $product->getNombre(),
            ':descripcion'  => $product->getDescripcion(),
            ':precio'       => $product->getPrecio(),
            ':stock'        => $product->getStock(),
            ':id'           => $product->getId(),
        ];

        if ($product->getImagen()) {
            $sql .= ", imagen = :imagen ";
            $params[':imagen'] = $product->getImagen();
        }

        $sql .= "WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM productos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    private function mapToModel($data): Product
    {
        $product = new Product();
        $product->setId((int)$data->id)
                ->setCategoriaId((int)$data->categoria_id)
                ->setNombre($data->nombre)
                ->setDescripcion($data->descripcion)
                ->setPrecio((float)$data->precio)
                ->setStock((int)$data->stock)
                ->setOferta($data->oferta)
                ->setFecha($data->fecha)
                ->setImagen($data->imagen);
        return $product;
    }
}
