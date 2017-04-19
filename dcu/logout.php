<?php 
	session_start();

$terminar =time()-365;
			   
			   if(isset($_COOKIE['idprofesor'])){
				   setcookie('id', $_SESSION['idprofesor'],$terminar);
				    setcookie('correo', $_SESSION['correo'],$terminar);
			   }
   
  session_unset();
session_destroy();

header("Refresh:5; url=index.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cerrar Seccion</title>
</head>
<body>
	<h1>Has cerrado seccion, seras redireccionado en 5 segundos</h1>
</body>
</html>