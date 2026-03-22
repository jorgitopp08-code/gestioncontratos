<table class="table mt-3">
<tr>
<th>Cédula</th>
<th>Nombre</th>
<th>Fecha</th>
<th>Teléfono</th>
<th>Correo</th>
<th>Acciones</th>
</tr>

<?php
$res=$conn->query("SELECT * FROM empleados");
while($r=$res->fetch_assoc()){
echo "<tr>
<td>{$r['cedula']}</td>
<td>{$r['nombre']}</td>
<td>{$r['fecha_ingreso']}</td>
<td>{$r['telefono']}</td>
<td>{$r['correo']}</td>
<td>
<a href='editar.php?id={$r['id']}' class='btn btn-warning btn-sm'>Editar</a>
<a href='eliminar.php?id={$r['id']}' class='btn btn-danger btn-sm'>Eliminar</a>
</td>
</tr>";
}
?>
</table>