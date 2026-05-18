<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Utils\Security;
use App\Utils\Utils;

class CategoriaController
{
    private CategoryRepository $categoryRepository;
    private ProductRepository $productRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
        $this->productRepository = new ProductRepository();
    }

    public function index(): void
    {
        Utils::isAdmin();
        $categorias = $this->categoryRepository->getAll();
        require_once __DIR__ . '/../../templates/categoria/index.php';
    }

    public function ver(): void
    {
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];

            // Get category
            $categoria = $this->categoryRepository->findById($id);

            if ($categoria) {
                // Get products by category
                $productos = $this->productRepository->findByCategory($id);
            }
        }

        require_once __DIR__ . '/../../templates/categoria/ver.php';
    }

    public function crear(): void
    {
        Utils::isAdmin();
        require_once __DIR__ . '/../../templates/categoria/crear.php';
    }

    public function save(): void
    {
        Utils::isAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'])) {
            if (!Security::validateCsrfToken($_POST['csrf_token'] ?? null)) {
                die("CSRF token validation failed.");
            }

            $category = new \App\Models\Category();
            $category->setNombre($_POST['nombre']);
            $this->categoryRepository->save($category);
        }
        header("Location: index.php?controller=categoria&action=index");
        exit();
    }
}
