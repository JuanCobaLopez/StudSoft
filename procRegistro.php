<?php
session_start();
include "db_connect.php";
$result=mysqli_query($conectador,"describe ".$_SESSION['tabla']);
$n=0;
$row2=mysqli_fetch_array(mysqli_query($conectador,"describe ".$_SESSION['tabla']));
//INSERT INTO `materia` (`id_materia`, `nombre_materia`, `grupo_materia`, `contrasena_materia`) VALUES ('7', 'Geologia', '1', 'GEO-123');
mysqli_query($conectador,"INSERT INTO ".$_SESSION['tabla']." (".$row2[0]."


	= '".$_POST[$row2[0]]."' where ".$kp[0]."='".$campo[0]."'");


while ($row=mysqli_fetch_array($result)){

if($n==0){}else{

$campo[$n]=$_POST[$row[0]];
$kp[$n]=$row[$n];

mysqli_query($conectador,"update ".$_SESSION['tabla']." set ".$row[0]."= '".$campo[$n]."' where ".$kp[0]."='".$campo[0]."'");

}

$n++;
}

$_SESSION['pagina']='materias';

header("Location:home.php");
?>