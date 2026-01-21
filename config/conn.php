<?php
require 'vendor/autoload.php';

use App\Config\Conn;

function loadEnv($path)
{
    if (!file_exists($path)) {
        throw new Exception("The .env file does not exist at: $path");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments (lines starting with #)
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Parse key-value pairs
        if (preg_match('/^\s*([\w.-]+)\s*=\s*(.*)?\s*$/', $line, $matches)) {
            $key = $matches[1];
            $value = $matches[2] ?? '';
            // Remove surrounding quotes if present
            $value = trim($value, '"\'');
            $_ENV[$key] = $value;
        }
    }
}

try {
    loadEnv(__DIR__ . '/../../.env');
} catch (Exception $e) {
    error_log("Error loading .env file: " . $e->getMessage());
}
$host = $_ENV['DB_HOST'] ?? 'localhost';
$user = $_ENV['DB_USER'] ?? 'root';
$password = $_ENV['DB_PASSWORD'] ?? '';
$dbName = $_ENV['DB_NAME'] ?? 'shortener';

try {
    $conn = new Conn(
        $host,
        $user,
        $password,
        $dbName
    );

    $pdo = $conn->getConn();
} catch (PDOException $e) {
    error_log("Database connection error: " . $e->getMessage());
    die("Database connection error.");
}
