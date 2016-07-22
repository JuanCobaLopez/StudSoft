<?php
session_start();
include "db_connect.php";

$llavePrimaria=$_GET["llavePrimaria"];

$row=mysqli_fetch_array(mysqli_query($conectador,"describe ".$_SESSION['tabla']));


if($_SESSION['tabla']=='usuario'){
mysqli_query($conectador, "DELETE FROM ".$_SESSION['tabla']." WHERE ".$row[0]." = '".$llavePrimaria."' ");
}else {
	mysqli_query($conectador, "DELETE FROM ".$_SESSION['tabla']." WHERE ".$row[0]." = ".$llavePrimaria." ");
}

mysqli_close($conectador);

if($_SESSION['tabla']=='usuario'){

	if($_SESSION['rol_a_tratar']=='docente'){$_SESSION['pagina']='docentes';}
	if($_SESSION['rol_a_tratar']=='estudiante'){$_SESSION['pagina']='estudiantes';}
	

}

if($_SESSION['tabla']=='materia'){
	$_SESSION['pagina']='materias';
}

header("Location:home.php");

?>