<?php
session_start();
$_SESSION['pagina']=$_GET["pagina"];
$_SESSION['llavePrimaria']=$_GET["llavePrimaria"];
$_SESSION['tabla']=$_GET["tabla"];
header("Location:home.php");
?>