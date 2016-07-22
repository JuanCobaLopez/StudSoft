<?php
session_start();
$_SESSION['pagina']=$_GET["pagina"];
header("Location:home.php");
?>