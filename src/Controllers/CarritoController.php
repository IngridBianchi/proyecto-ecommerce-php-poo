<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\ProductRepository;

class CarritoController
{
    private ProductRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function index(): void
    {
        $carrito = $_SESSION['carrito'] ?? [];
        require_once __DIR__ . '/../../templates/carrito/index.php';
    }

    public function add(): void
    {
        if (isset($_GET['id'])) {
            $producto_id = (int)$_GET['id'];
            
            $item_found = false;
            if (isset($_SESSION['carrito'])) {
                foreach ($_SESSION['carrito'] as $indice => $elemento) {
                    if ($elemento['id_producto'] === $producto_id) {
                        $_SESSION['carrito'][$indice]['unidades']++;
                        $item_found = true;
                        break;
                    }
                }
            }

            if (!$item_found) {
                $producto = $this->productRepository->findById($producto_id);
                if ($producto) {
                    $_SESSION['carrito'][] = [
                        "id_producto" => $producto->getId(),
                        "precio"      => $producto->getPrecio(),
                        "unidades"    => 1,
                        "producto"    => $producto
                    ];
                }
            }
        }
        header("Location: index.php?controller=carrito&action=index");
        exit();
    }

    public function delete(): void
    {
        if (isset($_GET['index'])) {
            $index = (int)$_GET['index'];
            unset($_SESSION['carrito'][$index]);
            $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindex array
        }
        header("Location: index.php?controller=carrito&action=index");
        exit();
    }

    public function up(): void
    {
        if (isset($_GET['index'])) {
            $index = (int)$_GET['index'];
            $_SESSION['carrito'][$index]['unidades']++;
        }
        header("Location: index.php?controller=carrito&action=index");
        exit();
    }

    public function down(): void
    {
        if (isset($_GET['index'])) {
            $index = (int)$_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;
            if ($_SESSION['carrito'][$index]['unidades'] <= 0) {
                unset($_SESSION['carrito'][$index]);
                $_SESSION['carrito'] = array_values($_SESSION['carrito']);
            }
        }
        header("Location: index.php?controller=carrito&action=index");
        exit();
    }

    public function delete_all(): void
    {
        unset($_SESSION['carrito']);
        header("Location: index.php?controller=carrito&action=index");
        exit();
    }
}
