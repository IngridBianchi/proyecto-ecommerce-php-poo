<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Config\Database;
use App\Models\Order;
use PDO;

class OrderRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM pedidos ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?Order
    {
        $sql = "SELECT * FROM pedidos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch();

        return $data ? $this->mapToModel($data) : null;
    }

    public function findByUser(int $userId): array
    {
        $sql = "SELECT * FROM pedidos WHERE usuario_id = :usuario_id ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':usuario_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function findLatestByUser(int $userId): ?Order
    {
        $sql = "SELECT * FROM pedidos WHERE usuario_id = :usuario_id ORDER BY id DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':usuario_id' => $userId]);
        $data = $stmt->fetch();

        return $data ? $this->mapToModel($data) : null;
    }

    public function save(Order $order, array $cartItems): bool
    {
        try {
            $this->db->beginTransaction();

            $sqlOrder = "INSERT INTO pedidos (usuario_id, provincia, localidad, direccion, coste, estado, fecha, hora) "
                      . "VALUES (:usuario_id, :provincia, :localidad, :direccion, :coste, :estado, CURDATE(), CURTIME())";
            $stmtOrder = $this->db->prepare($sqlOrder);
            $stmtOrder->execute([
                ':usuario_id' => $order->getUsuarioId(),
                ':provincia'  => $order->getProvincia(),
                ':localidad'  => $order->getLocalidad(),
                ':direccion'  => $order->getDireccion(),
                ':coste'      => $order->getCoste(),
                ':estado'     => $order->getEstado()
            ]);

            $orderId = (int)$this->db->lastInsertId();

            $sqlItems = "INSERT INTO lineas_pedidos (pedido_id, producto_id, unidades) VALUES (:pedido_id, :producto_id, :unidades)";
            $stmtItems = $this->db->prepare($sqlItems);

            foreach ($cartItems as $item) {
                $stmtItems->execute([
                    ':pedido_id'   => $orderId,
                    ':producto_id' => $item['id_producto'],
                    ':unidades'    => $item['unidades']
                ]);
            }

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            error_log("Order save failed: " . $e->getMessage());
            return false;
        }
    }

    public function getProductsByOrder(int $orderId): array
    {
        $sql = "SELECT pr.*, lp.unidades FROM productos pr "
             . "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
             . "WHERE lp.pedido_id = :pedido_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':pedido_id' => $orderId]);
        return $stmt->fetchAll();
    }

    public function updateStatus(int $id, string $status): bool
    {
        $sql = "UPDATE pedidos SET estado = :estado WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':estado' => $status, ':id' => $id]);
    }

    private function mapToModel($data): Order
    {
        $order = new Order();
        $order->setId((int)$data->id)
              ->setUsuarioId((int)$data->usuario_id)
              ->setProvincia($data->provincia)
              ->setLocalidad($data->localidad)
              ->setDireccion($data->direccion)
              ->setCoste((float)$data->coste)
              ->setEstado($data->estado)
              ->setFecha($data->fecha)
              ->setHora($data->hora);
        return $order;
    }
}
