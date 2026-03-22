<?php
include("db.php");
$conn->query("DELETE FROM empleados WHERE id=".$_GET["id"]);
header("Location:dashboard.php");
?>
