<?php
session_start();
include("db.php");

// Validar sesión
if (!isset($_SESSION["admin"])) {
    header("Location: index.html");
    exit();
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Capturar y limpiar datos
    $cedula = trim($_POST["cedula"]);
    $nombre = trim($_POST["nombre"]);
    $fecha  = $_POST["fecha_ingreso"];
    $telefono = trim($_POST["telefono"]);
    $correo = trim($_POST["correo"]);

    // Validaciones
    if (empty($cedula) || empty($nombre) || empty($fecha)) {
        $mensaje = "❌ Los campos obligatorios están vacíos";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL) && !empty($correo)) {
        $mensaje = "❌ Correo inválido";
    } else {

        // Prepared Statement (seguridad)
        $stmt = $conn->prepare("INSERT INTO empleados 
        (cedula, nombre, fecha_ingreso, telefono, correo) 
        VALUES (?, ?, ?, ?, ?)");

        $stmt->bind_param("sssss", $cedula, $nombre, $fecha, $telefono, $correo);

        if ($stmt->execute()) {
            header("Location: dashboard.php?ok=1");
            exit();
        } else {
            $mensaje = "❌ Error al guardar";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear Empleado</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: #f4f6f9;
}
.card{
    border-radius: 15px;
}
</style>

</head>

<body>

<div class="container mt-5">

<div class="card shadow p-4 col-md-6 mx-auto">

<h3 class="mb-3 text-center">➕ Crear Empleado</h3>

<?php if($mensaje): ?>
<div class="alert alert-danger"><?php echo $mensaje; ?></div>
<?php endif; ?>

<form method="POST">

<div class="mb-3">
<label>Cédula *</label>
<input type="text" name="cedula" class="form-control" required>
</div>

<div class="mb-3">
<label>Nombre *</label>
<input type="text" name="nombre" class="form-control" required>
</div>

<div class="mb-3">
<label>Fecha de Ingreso *</label>
<input type="date" name="fecha_ingreso" class="form-control" required>
</div>

<div class="mb-3">
<label>Teléfono</label>
<input type="text" name="telefono" class="form-control">
</div>

<div class="mb-3">
<label>Correo</label>
<input type="email" name="correo" class="form-control">
</div>

<div class="d-flex justify-content-between">
    <a href="dashboard.php" class="btn btn-secondary">⬅ Volver</a>
    <button class="btn btn-success">💾 Guardar</button>
</div>

</form>

</div>
</div>

</body>
</html>