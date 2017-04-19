<?php

session_start();

if( (isset($_SESSION['idprofesor']) && isset($_SESSION['correo']) || isset($_COOKIE['idprofesor']))){
	if(isset($_COOKIE['idprofesor'])){
	$_SESSION['idprofesor']=$_COOKIE['id'];
	$_SESSION['correo']=$_COOKIE['correo'];
	}
header("Location:login.php");
} 
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<title></title>
	
	<style>
		/*body {
   
}
*/
		body{
			 background-image: url('itla.jpg');
		}
		
		a{
			color: white;
		}
		

	</style>
</head>
<body>
  
<div class="container-fluid">
	<div class="modal-dialog">
		
		<div class="modal-content">
		 <div class="modal-header">
		 	<h1 class="text-center">ITLA </h1>
		 
		 </div>
		</div>
		<div class="modal-body">
			<form class="col-xs-12 center-block" action="inicio.php" method="POST">
				
				<div class="form-group">
					<input type="text" name="correo" class="form-control input-lg" placeholder="&#128272; Correo" required>
				</div>
				<div class="form-group">
				
					<input type="password"  name="clave" class="form-control input-lg" placeholder="&#128273;  Contrasena" required>
					
				
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-block btn-lg btn-primary" value="login">
					<span class="pull-right"><a href="#">Olvido su contraseña?</a></span> 
					<label for="" class="checkbox-inline">
						<input type="checkbox" name="recordar" value="activo"> Mantener seccion iniciada
					</label>
					
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>