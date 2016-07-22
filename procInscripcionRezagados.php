<?php
session_start();
include "db_connect.php";

$userName=$_POST["userName"];
$idMateria=$_POST["idMateria"];

//CONSULTA QUE GUARDA EN LA TABLA USUARIO 
mysqli_query($conectador,"INSERT INTO `usuario`(`userName`, `password`, `rol`, `nombre`, `apellido`, `foto`, `email`, `telefono`, `descripcion`, `url`,`estado`) VALUES ('".$userName."','2009CEC124','estudiante','','','','','','','','Habilitado')");

//CONSULTA QUE GUARDA EN LA TABLA MATERIA_USUARIO
mysqli_query($conectador,"INSERT INTO `materia_usuario`(`id_materia_usuario`, `userName`, `id_materia`) VALUES ('".rand()."','".$userName."',".$idMateria.")");

$_SESSION['pagina']='panel de control del administrador';

header("Location:home.php");

?>