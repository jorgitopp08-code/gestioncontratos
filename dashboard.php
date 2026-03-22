<?php
session_start();
include("db.php");

if (!isset($_SESSION["admin"])) {
    header("Location: index.html");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Empleados</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <div class="d-flex justify-content-between">
        <h2>👨‍💼 Gestión de Empleados</h2>
        <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
    </div>

    <a href="crear.php" class="btn btn-success my-3">➕ Nuevo Empleado</a>

    <input type="text" id="buscar" class="form-control mb-3" placeholder="Buscar empleado...">

    <table class="table table-bordered table-striped" id="tabla">
        <thead class="table-dark">
            <tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

        <?php
        $sql = "SELECT * FROM empleados";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['cedula']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['fecha_ingreso']}</td>
                <td>{$row['telefono']}</td>
                <td>{$row['correo']}</td>
                <td>
                    <a href='editar.php?id={$row['id']}' class='btn btn-warning btn-sm'>Editar</a>
                    <a href='eliminar.php?id={$row['id']}' class='btn btn-danger btn-sm'>Eliminar</a>
                </td>
            </tr>";
        }
        ?>

        </tbody>
    </table>

</div>

<script>
document.getElementById("buscar").addEventListener("keyup", function() {
    let filtro = this.value.toLowerCase();
    let filas = document.querySelectorAll("#tabla tbody tr");

    filas.forEach(fila => {
        fila.style.display = fila.innerText.toLowerCase().includes(filtro) ? "" : "none";
    });
});
</script>

</body>
</html>