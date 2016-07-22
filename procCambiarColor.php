<?php
session_start();
$_SESSION['colorFondo']=$_GET["colorFondo"];

mysqli_close($conectador);
header("Location:home.php");

}

?>