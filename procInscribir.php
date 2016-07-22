<?php
session_start();
include "db_connect.php";
$colocarMateria=$_POST["colocarMateria"];
$colocarGrupoMateria=$_POST["colocarGrupoMateria"];
$colocarContraseñaMateria=$_POST["colocarContraseñaMateria"];
$idMat = rand();
//CREACION DE LA MATERIA
mysqli_query($conectador,"INSERT INTO `materia` (`id_materia`, `nombre_materia`, `grupo_materia`, `contrasena_materia`) VALUES ('".$idMat."', '".$colocarMateria."', '".$colocarGrupoMateria."', '".$colocarContraseñaMateria."');");
$dir_subida = 'descargas/';
$fichero_subido = $dir_subida . basename($_FILES['fichero_usuario']['name']);
echo '<pre>';
if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
    echo "El fichero es válido y se subió con éxito.\n";
} else {
    echo "¡Posible ataque de subida de ficheros!\n";
}
mysqli_query($conectador,"INSERT INTO `archivo`(`id_archivo`, `ruta`, `nombreArchivo`) VALUES ('".rand()."','".$fichero_subido."','".$fichero_subido."')");


$file = fopen("".$fichero_subido."", "r");

while(!feof($file)) {
$fila = fgets($file);

//CONSULTA QUE GUARDA EN LA TABLA USUARIO 
mysqli_query($conectador,"INSERT INTO `usuario`(`userName`, `password`, `rol`, `nombre`, `apellido`, `foto`, `email`, `telefono`, `descripcion`, `url`, `estado`) VALUES ('".$fila."','2009CEC124','estudiante','','','','','','','','habilitado')");

//CONSULTA QUE GUARDA EN LA TABLA MATERIA_USUARIO
mysqli_query($conectador,"INSERT INTO `materia_usuario`(`id_materia_usuario`, `userName`, `id_materia`) VALUES ('".rand()."','".$fila."',".$idMat.")");

}

fclose($file);

$_SESSION['pagina']='panel de control del administrador';

header("Location:home.php");

?>