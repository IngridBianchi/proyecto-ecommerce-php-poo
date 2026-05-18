<?php

declare(strict_types=1);

namespace App\Utils;

class Cart
{
    public static function getStats(): array
    {
        $stats = [
            'count' => 0,
            'total' => 0
        ];

        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $producto) {
                $stats['count'] += $producto['unidades'];
                $stats['total'] += $producto['precio'] * $producto['unidades'];
            }
        }

        return $stats;
    }
}
