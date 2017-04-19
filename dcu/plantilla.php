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

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ITLA</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/scrolling-nav.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body style="background-color:#ecf0f1;">

    <!-- Navigation -->
   
   <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">

      <a href="logout.php">
      <p class="navbar-text navbar-right"><i class=" glyphicon glyphicon-log-out"></i>
      </a> 
    </div>
  </div>
</nav>
    <img src="itla.png" class="img-responsive" alt="Responsive image">
<hr>
	<center><h2> Materias Asigandas</h2></center>
	<hr>
	
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
	






            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    

  
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Scrolling Nav JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/scrolling-nav.js"></script>

</body>

</html>
