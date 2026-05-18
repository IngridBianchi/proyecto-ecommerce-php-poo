<?php

declare(strict_types=1);

namespace App\Utils;

class Utils
{
    public static function showStatus(string $status): string
    {
        $value = 'Pendiente';

        if ($status == 'confirm') {
            $value = 'Pendiente';
        } elseif ($status == 'preparation') {
            $value = 'En preparación';
        } elseif ($status == 'ready') {
            $value = 'Preparado para enviar';
        } elseif ($status == 'sended') {
            $value = 'Enviado';
        }

        return $value;
    }

    public static function isAdmin(): void
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php");
            exit();
        }
    }

    public static function isIdentity(): void
    {
        if (!isset($_SESSION['identity'])) {
            header("Location: index.php");
            exit();
        }
    }
}
