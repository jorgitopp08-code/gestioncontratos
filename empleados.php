<?php
session_start();
include "conexion.php";
if(!isset($_SESSION['admin'])) die("No autorizado");

if(isset($_POST['guardar'])){
$id=$_POST['id'];

if($id==""){
$stmt=$conn->prepare("INSERT INTO empleados VALUES(NULL,?,?,?,?,?,?)");
$stmt->bind_param("ssssss",$_POST['cedula'],$_POST['nombre'],$_POST['email'],$_POST['telefono'],$_POST['fecha'],$_POST['tipo']);
}else{
$stmt=$conn->prepare("UPDATE empleados SET cedula=?,nombre=?,email=?,telefono=?,fecha_ingreso=?,tipo_contrato=? WHERE id=?");
$stmt->bind_param("ssssssi",$_POST['cedula'],$_POST['nombre'],$_POST['email'],$_POST['telefono'],$_POST['fecha'],$_POST['tipo'],$id);
}
$stmt->execute();
}

if(isset($_GET['eliminar'])){
$stmt=$conn->prepare("DELETE FROM empleados WHERE id=?");
$stmt->bind_param("i",$_GET['eliminar']);
$stmt->execute();
}

header("Location: dashboard.php");
?>