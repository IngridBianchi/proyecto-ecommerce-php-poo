<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Utils\Cart;
use App\Utils\Security;
use App\Utils\Utils;

class PedidoController
{
    private OrderRepository $orderRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }

    public function hacer(): void
    {
        Utils::isIdentity();
        require_once __DIR__ . '/../../templates/pedido/hacer.php';
    }

    public function add(): void
    {
        Utils::isIdentity();
        $user = $_SESSION['identity'];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::validateCsrfToken($_POST['csrf_token'] ?? null)) {
                die("CSRF validation failed.");
            }

            $provincia = $_POST['provincia'] ?? '';
            $localidad = $_POST['localidad'] ?? '';
            $direccion = $_POST['direccion'] ?? '';
            
            $stats = Cart::getStats();
            $coste = (float)$stats['total'];

            if (!empty($provincia) && !empty($localidad) && !empty($direccion)) {
                $order = new Order();
                $order->setUsuarioId((int)$user->getId())
                        ->setProvincia($provincia)
                        ->setLocalidad($localidad)
                        ->setDireccion($direccion)
                        ->setCoste($coste);

                $cartItems = $_SESSION['carrito'] ?? [];
                if ($this->orderRepository->save($order, $cartItems)) {
                    $_SESSION['pedido'] = "complete";
                    unset($_SESSION['carrito']);
                } else {
                    $_SESSION['pedido'] = "failed";
                }
            } else {
                $_SESSION['pedido'] = "failed";
            }
        }
        header("Location: index.php?controller=pedido&action=confirmado");
        exit();
    }

    public function confirmado(): void
    {
        Utils::isIdentity();
        $user = $_SESSION['identity'];
        $pedido = $this->orderRepository->findLatestByUser((int)$user->getId());
        $productos = [];
        if ($pedido) {
            $productos = $this->orderRepository->getProductsByOrder((int)$pedido->getId());
        }
        require_once __DIR__ . '/../../templates/pedido/confirmado.php';
    }

    public function mis_pedidos(): void
    {
        Utils::isIdentity();
        $user = $_SESSION['identity'];
        $pedidos = $this->orderRepository->findByUser((int)$user->getId());
        require_once __DIR__ . '/../../templates/pedido/mis_pedidos.php';
    }

    public function detalle(): void
    {
        Utils::isIdentity();
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $pedido = $this->orderRepository->findById($id);
            $productos = $this->orderRepository->getProductsByOrder($id);
            require_once __DIR__ . '/../../templates/pedido/detalle.php';
        } else {
            header("Location: index.php?controller=pedido&action=mis_pedidos");
            exit();
        }
    }

    public function gestion(): void
    {
        Utils::isAdmin();
        $pedidos = $this->orderRepository->getAll();
        $gestion = true;
        require_once __DIR__ . '/../../templates/pedido/mis_pedidos.php';
    }

    public function estado(): void
    {
        Utils::isAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::validateCsrfToken($_POST['csrf_token'] ?? null)) {
                die("CSRF validation failed.");
            }
            $id = (int)$_POST['pedido_id'];
            $estado = $_POST['estado'];
            $this->orderRepository->updateStatus($id, $estado);
            header("Location: index.php?controller=pedido&action=detalle&id=" . $id);
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
    }
}
