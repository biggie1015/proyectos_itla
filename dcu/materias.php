<?php
require ('database.php');
require('config.php');

if(isset($_GET['materia'])){ 
   

 $gid=$_GET['materia'];
	
}
   

    $db = new database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
     
    $db->preparar(" SELECT nombre_estu,nombre_materia
					FROM estudiantes as est
					INNER JOIN materias AS mat
					ON est.id_materia = mat.id_materias WHERE id_materias ='$gid' ");
    $db->ejecutar();
    $db->prep()->bind_result($dbnombre_estu,$dbmateria);

	   
   
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
	<title>Asistencia Materias</title>
</head>
<body style="background-color:#ecf0f1;">

    <!-- Navigation -->
   
   <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="plantilla.php">
        Atras
      </a>
      <a href="logout.php">
      <p class="navbar-text navbar-right"><i class=" glyphicon glyphicon-log-out"></i>
      </a>  
    </div>
  </div>
</nav>
    <img src="itla.png" class="img-responsive" alt="Responsive image">
<hr>
<center><a class="btn btn-default" href="pasar_lista.php" role="button">Pasar Lista Nueva</a></center>
<center><h3>Estudiantes Inscritos</h3></center>
	
	
	
	
		<?php 
	     
	   while($db->resultado()){
		   echo"
<ul>
<hr>
  <li>$dbnombre_estu</li>
</ul>
		   
		   ";
	   }
	  
	?>


</body>
</html>