<?php
session_start();
$_SESSION['foto']=$_GET["foto"];
$_SESSION['pagina']=$_GET["pagina"];
header("Location:home.php");
?>