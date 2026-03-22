<?php
include("db.php");

$id = $_GET["id"];

if($_POST){
    $cedula = $_POST["cedula"];
    $nombre = $_POST["nombre"];

    $conn->query("UPDATE empleados 
                  SET cedula='$cedula', nombre='$nombre' 
                  WHERE id=$id");

    header("Location: dashboard.php");
}

$res = $conn->query("SELECT * FROM empleados WHERE id=$id");
$row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

<h3>Editar Empleado</h3>

<form method="POST">
    <input type="text" name="cedula" value="<?php echo $row['cedula']; ?>" class="form-control mb-2">
    <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" class="form-control mb-2">

    <button class="btn btn-success">Actualizar</button>
    <a href="dashboard.php" class="btn btn-secondary">Volver</a>
</form>

</body>
</html>