<?php
session_start();
include "db_connect.php";
$userName=$_GET["userName"];
$password=$_GET["password"];

$result = mysqli_query($conectador, "select userName,password,rol from usuario where userName = '$userName' ;");

while ($row=mysqli_fetch_array($result)){

if($password==$row[1]){

$_SESSION['userName']=$row[0];
$_SESSION['password']=$row[1];
$_SESSION['rol']=$row[2];

if($_SESSION['rol']=='administrador'){
$_SESSION['pagina']='panel de control del administrador';
}
if($_SESSION['rol']=='docente'){
$_SESSION['pagina']='materias del docente';
}
if($_SESSION['rol']=='estudiante'){
$_SESSION['pagina']='materias del estudiante';
}

}

mysqli_close($conectador);
header("Location:home.php");

}

?>