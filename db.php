<?php
declare(strict_types=1);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Configura estos valores desde variables de entorno en produccion.
$host = getenv('DB_HOST') ?: '127.0.0.1';
$port = (int) (getenv('DB_PORT') ?: '3306');
$database = getenv('DB_NAME') ?: 'empresa';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';

try {
    $conn = new mysqli($host, $user, $password, $database, $port);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $exception) {
    error_log('Database connection failed: ' . $exception->getMessage());
    http_response_code(500);
    exit('No se pudo conectar a la base de datos.');
}
