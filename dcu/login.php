<?php 

session_start(); 
require('database.php');
require('config.php');



if(!$_SESSION['idprofesor'] && !$_SESSION['correo']){
	header("Location:index.php");
	exit;
}

$correo=$_SESSION['correo'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Asistencia Materias</title>
	<style>
	
		.barra{
			position: relative;
			background-color: aquamarine;
			width: 100%;
			height: 85px;
			float: left;
			position: fixed;
			z-index: 1;

		}
		
	
	</style>
</head>
<body>
	
	<div class="barra">
	<h2> ITLA</h2>
	</div>
	<?php 
	
	for($x=0;$x<=4;$x++){
		echo "<br>";
	}
	?>
	
	<center>
	<a href="logout.php">Cerrar Seccion</a>
	<h3>Materias</h3>
	<hr>
	</center>


	<?php 
	
	if($_POST){
		extract($_POST,EXTR_OVERWRITE);
	}
		  $db = new database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
     
   
   
 
    $db->preparar("SELECT id_materias,Correo,nombre_materia,contrasena
    			  FROM profesor AS pro
				  INNER JOIN materias AS p
     			  ON pro.id_profesor = p.id_profesor 
				  WHERE Correo = '$correo'");
		
    $db->ejecutar();
    $db->prep()->bind_result($id,$dbcorreo,$dbmateria,$dbcontrasena);
    
	while($db->resultado()){
		echo"
		   <ul>
		   <li><a href='materias.php?materia=$id'>$dbmateria</li></a>
		   
		   </ul>
		   <hr>
		";
	}
		
		$db->liberar();
		?>
	



	</body>
	
</html>


