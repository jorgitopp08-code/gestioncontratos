<?php
include("db.php");
if($_POST){
$conn->query("INSERT INTO empleados (cedula,nombre) VALUES ('$_POST[cedula]','$_POST[nombre]')");
header("Location:dashboard.php");
}
?>
<form method="POST">
<input name="cedula" placeholder="Cedula">
<input name="nombre" placeholder="Nombre">
<input name="fecha_ingreso" type="date" placeholder="Fecha de Ingreso">
<input name="telefono" placeholder="Teléfono">
<input name="correo" placeholder="Correo">
<button>Guardar</button>
</form>
