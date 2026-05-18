<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Utils\Security;
use App\Repositories\CategoryRepository;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->safeLoad();

// Session configuration
ini_set('session.name', $_ENV['SESSION_NAME'] ?? 'ecommerce_session');
session_start();

// Constants for templates
$baseUrl = $_ENV['APP_URL'] ?? 'http://localhost:8080/';
$baseUrl = rtrim($baseUrl, '/') . '/';

// Initialize CSRF token
Security::generateCsrfToken();

// Common data for layout
$categoryRepo = new CategoryRepository();
$allCategories = $categoryRepo->getAll();

// Simple Router
$controllerName = $_GET['controller'] ?? 'product';
$actionName = $_GET['action'] ?? 'index';

$controllerClass = "App\\Controllers\\" . ucfirst($controllerName) . "Controller";

// Buffer output to wrap it in layout later
ob_start();

if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    if (method_exists($controller, $actionName)) {
        $controller->$actionName();
    } else {
        $error = new \App\Controllers\ErrorController();
        $error->index();
    }
} else {
    $error = new \App\Controllers\ErrorController();
    $error->index();
}

$viewContent = ob_get_clean();

// Render Layout
require_once __DIR__ . '/../templates/layout/header.php';
require_once __DIR__ . '/../templates/layout/sidebar.php';
echo $viewContent;
require_once __DIR__ . '/../templates/layout/footer.php';
