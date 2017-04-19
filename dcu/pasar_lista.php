<?php
session_start();
require ('database.php');
require('config.php');
?>
<?php
$correo  =$_SESSION['correo'];	
	 $db = new database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
     
    $db->preparar(" select Correo,nombre_estu from profesor inner join estudiantes
on profesor.id_profesor= estudiantes.id_estu where Correo= '$correo'");
    $db->ejecutar();
    $db->prep()->bind_result($dbcorreo,$dbnombre_estudiante);


	 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/scrolling-nav.css" rel="stylesheet">

</head>
<body style="background-color:#ecf0f1;">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="materias.php">
        Atras
      </a>
      <a href="logout.php">
      <p class="navbar-text navbar-right"><i class=" glyphicon glyphicon-log-out"></i>
      </a>  
    </div>
  </div>
</nav>
<center><h2>Nueva Lista</h2></center>
  
  <input type="search" class="form-control col-lg" \placeholder="Buscar Estudiante">
  <table class="table">
  	
  	<thead>
  		<tr>
  		<td>#</td>
  			<td>Nombre</td>
  			<td>A/P</td>
  		</tr>
  	</thead>
  	<tbody>
  		<?php 
		$conteo=0;
		while($db->resultado()){
			$conteo++;
		echo "
		
		<tr>
		<td>$conteo</td>
		<td> $dbnombre_estudiante </td>
		<td>
		<input type='checkbox'>A
		<input type='checkbox'>P
		</td>
		</tr>
		
		
		
		";
		}
		?>
  	</tbody>
  	
  </table>
  
 <?php
	while($db->resultado()){
	echo "
	     
		 
	";
		}
	    
    
	?>
	<hr>
	<center>
 	<a class="btn btn-primary" href="registro.php" role="button">Enviar</a>
  	</center>
</body>
</html>