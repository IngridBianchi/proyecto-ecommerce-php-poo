<?php

declare(strict_types=1);

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            try {
                $host = $_ENV['DB_HOST'] ?? 'db';
                $db   = $_ENV['DB_NAME'] ?? 'tienda_master';
                $user = $_ENV['DB_USER'] ?? 'user';
                $pass = $_ENV['DB_PASSWORD'] ?? 'password';
                $port = $_ENV['DB_PORT'] ?? '3306';
                $charset = 'utf8mb4';

                $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];

                self::$instance = new PDO($dsn, $user, $pass, $options);
            } catch (PDOException $e) {
                // In production, log this and show a generic message
                error_log("Connection failed: " . $e->getMessage());
                die("Error de conexión a la base de datos.");
            }
        }

        return self::$instance;
    }
}
