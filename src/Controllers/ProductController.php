<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Utils\Security;
use App\Utils\Utils;

class ProductController
{
    private ProductRepository $productRepository;
    private CategoryRepository $categoryRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
        $this->categoryRepository = new CategoryRepository();
    }

    public function index(): void
    {
        $productos = $this->productRepository->getRandom(6);
        require_once __DIR__ . '/../../templates/producto/destacados.php';
    }

    public function ver(): void
    {
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $product = $this->productRepository->findById($id);
            require_once __DIR__ . '/../../templates/producto/ver.php';
        }
    }

    public function gestion(): void
    {
        Utils::isAdmin();
        $productos = $this->productRepository->getAll();
        require_once __DIR__ . '/../../templates/producto/gestion.php';
    }

    public function crear(): void
    {
        Utils::isAdmin();
        $categorias = $this->categoryRepository->getAll();
        require_once __DIR__ . '/../../templates/producto/crear.php';
    }

    public function save(): void
    {
        Utils::isAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::validateCsrfToken($_POST['csrf_token'] ?? null)) {
                die("CSRF validation failed.");
            }

            $nombre = $_POST['nombre'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            $precio = (float)($_POST['precio'] ?? 0);
            $stock = (int)($_POST['stock'] ?? 0);
            $categoria = (int)($_POST['categoria'] ?? 0);

            $product = new Product();
            $product->setNombre($nombre)
                    ->setDescripcion($descripcion)
                    ->setPrecio($precio)
                    ->setStock($stock)
                    ->setCategoriaId($categoria);

            // Save file
            if (isset($_FILES['imagen']) && $_FILES['imagen']['name'] !== '') {
                $file = $_FILES['imagen'];
                $filename = $file['name'];
                $mimetype = $file['type'];

                if ($mimetype === "image/jpg" || $mimetype === 'image/jpeg' || $mimetype === 'image/png' || $mimetype === 'image/gif') {
                    if (!is_dir('uploads/images')) {
                        mkdir('uploads/images', 0777, true);
                    }
                    move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                    $product->setImagen($filename);
                }
            }

            if (isset($_GET['id'])) {
                $id = (int)$_GET['id'];
                $product->setId($id);
            }

            if ($this->productRepository->save($product)) {
                $_SESSION['producto'] = "complete";
            } else {
                $_SESSION['producto'] = "failed";
            }
        } else {
            $_SESSION['producto'] = "failed";
        }
        header('Location: index.php?controller=product&action=gestion');
        exit();
    }

    public function editar(): void
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $edit = true;
            $product = $this->productRepository->findById($id);
            $categorias = $this->categoryRepository->getAll();
            require_once __DIR__ . '/../../templates/producto/crear.php';
        } else {
            header('Location: index.php?controller=product&action=gestion');
            exit();
        }
    }

    public function eliminar(): void
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $delete = $this->productRepository->delete($id);
            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }
        header('Location: index.php?controller=product&action=gestion');
        exit();
    }
}
