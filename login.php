<?php
session_start();
include "conexion.php";

$user=$_POST['usuario'];
$pin=hash('sha256',$_POST['pin']);

$stmt=$conn->prepare("SELECT * FROM admin WHERE usuario=? AND pin=?");
$stmt->bind_param("ss",$user,$pin);
$stmt->execute();
$res=$stmt->get_result();

if($res->num_rows>0){
$_SESSION['admin']=$user;
header("Location: dashboard.php");
}else{
echo "<script>alert('Error');location='index.html'</script>";
}
?>