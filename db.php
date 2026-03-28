<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $host = "mysql-apijorge.alwaysdata.net";
    $user = "apijorge";
    $pass = "clase1234";
    $db = "apijorge_gestion_empleados";

    $conn = new mysqli($host, $user, $pass, $db, 3306);
    $conn->set_charset("utf8mb4");

} catch (mysqli_sql_exception $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>