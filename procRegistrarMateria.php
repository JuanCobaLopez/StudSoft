<?php
session_start();
include "db_connect.php";

$ultimo = mysqli_fetch_array(mysqli_query($conectador, "select max(id_materia) from `materia` ;"));
$ultimo[0]++;

mysqli_query($conectador,"insert into `materia` (`id_materia`, `nombre_materia`, `grupo_materia`, `contrasena_materia`) values ('".$ultimo[0]."', '', '', '');");

$result2=mysqli_query($conectador,"describe ".$_SESSION['tabla']);
$n=0;

while ($row=mysqli_fetch_array($result2)){
$campo[$n]=$_POST[$row[0]];
$kp[$n]=$row[$n];
mysqli_query($conectador,"update ".$_SESSION['tabla']." set ".$row[0]."= '".$campo[$n]."' where ".$kp[0]."='".$ultimo[0]."'");
$n++;
}



$_SESSION['pagina']='materias';

header("Location:home.php");
?>