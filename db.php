<?php
$host = "sql210.infinityfree.com";
$user = "if0_41392256";
$pass = "7gLLLrvpdiB";
$db = "if0_41392256_apijorge_empleados";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>