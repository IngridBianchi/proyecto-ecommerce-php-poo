<?php

declare(strict_types=1);

namespace App\Controllers;

class ErrorController
{
    public function index(): void
    {
        echo "<h1>La página que buscas no existe</h1>";
    }
}
