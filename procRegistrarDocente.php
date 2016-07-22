<?php
session_start();
include "db_connect.php";

$_SESSION['tabla']='usuario';

$userName=$_POST["userName"];
mysqli_query($conectador,"insert into `usuario` (`userName`, `password`, `rol`) values ('".$userName."', '', '');");

$result2=mysqli_query($conectador,"describe ".$_SESSION['tabla']);
$n=0;

while ($row=mysqli_fetch_array($result2)){
$campo[$n]=$_POST[$row[0]];
$kp[$n]=$row[$n];

mysqli_query($conectador,"update ".$_SESSION['tabla']." set ".$row[0]."= '".$campo[$n]."' where ".$kp[0]."='".$userName."'");

$n++;
}

if($_SESSION['tabla']=='usuario'){

	if($_SESSION['rol_a_tratar']=='docente'){$_SESSION['pagina']='docentes';}
	if($_SESSION['rol_a_tratar']=='estudiante'){$_SESSION['pagina']='estudiantes';}
	

}

if($_SESSION['tabla']=='materia'){
	$_SESSION['pagina']='materias';
}

header("Location:home.php");
?>