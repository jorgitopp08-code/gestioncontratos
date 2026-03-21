<?php
session_start();
include "conexion.php";
if(!isset($_SESSION['admin'])) header("Location:index.html");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-4">

<div class="d-flex justify-content-between">
<h3>Empleados</h3>
<a href="logout.php" class="btn btn-danger">Salir</a>
</div>

<form action="empleados.php" method="POST" class="card p-3 mt-3">
<input type="hidden" name="id" id="id">

<div class="row">
<div class="col"><input class="form-control" name="cedula" id="cedula" placeholder="Cédula"></div>
<div class="col"><input class="form-control" name="nombre" id="nombre" placeholder="Nombre"></div>
<div class="col"><input class="form-control" name="email" id="email" placeholder="Email"></div>
</div>

<div class="row mt-2">
<div class="col"><input class="form-control" name="telefono" id="telefono" placeholder="Teléfono"></div>
<div class="col"><input class="form-control" type="date" name="fecha" id="fecha"></div>
<div class="col">
<select class="form-control" name="tipo" id="tipo">
<option value="indefinido">Indefinido</option>
<option value="fijo">Fijo</option>
</select>
</div>
</div>

<button class="btn btn-success mt-2" name="guardar">Guardar</button>
</form>

<table class="table table-striped mt-3">
<tr><th>Cédula</th><th>Nombre</th><th>Acciones</th></tr>

<?php
$res=$conn->query("SELECT * FROM empleados");
while($r=$res->fetch_assoc()){
echo "<tr>
<td>{$r['cedula']}</td>
<td>{$r['nombre']}</td>
<td>
<button class='btn btn-warning btn-sm' onclick='editar(".json_encode($r).")'>Editar</button>
<a class='btn btn-danger btn-sm' href='empleados.php?eliminar={$r['id']}'>Eliminar</a>
</td>
</tr>";
}
?>

</table>

</div>

<script>
function editar(e){
document.getElementById('id').value=e.id;
document.getElementById('cedula').value=e.cedula;
document.getElementById('nombre').value=e.nombre;
document.getElementById('email').value=e.email;
document.getElementById('telefono').value=e.telefono;
document.getElementById('fecha').value=e.fecha_ingreso;
document.getElementById('tipo').value=e.tipo_contrato;
}
</script>

</body>
</html>