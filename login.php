<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $conn->real_escape_string($_POST["usuario"]);
    $pin = $conn->real_escape_string($_POST["pin"]);

    $sql = "SELECT * FROM admin WHERE usuario='$usuario' AND pin='$pin'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION["admin"] = $usuario;
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Credenciales incorrectas'); window.location='index.html';</script>";
    }
}
?>