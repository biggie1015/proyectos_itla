<?php session_start(); ?>

<?php
require('database.php');
require('config.php');

if($_POST){
	
	extract($_POST,EXTR_OVERWRITE);
	
	
}

if(isset($correo) && isset($clave)){
	  $db = new database(DB_HOST,DB_USER,DB_PASS,DB_NAME);

    $db->preparar("SELECT id_profesor,Correo,contrasena
	               FROM profesor
	 			   WHERE Correo = '$correo'");
		
    $db->ejecutar();
    $db->prep()->bind_result($id,$dbcorreo,$dbcontrasena);
    $db->resultado();
    $db->liberar();
  
	  
       if($correo ==$dbcorreo){
           
           if($clave == $dbcontrasena){
			   $_SESSION['idprofesor']=$id;
			   $_SESSION['correo']=$correo;
			   
			    $terminar =time()+365*24*60*60;
			   
			   if($recordar=='activo'){
				   setcookie('id', $_SESSION['idprofesor'],$terminar);
				    setcookie('correo', $_SESSION['correo'],$terminar);
			   
			   }
			   header( "Location:plantilla.php");
			   
			   $db->cerrar();
			   
		   }
	       	   
	   }
	else{
			  echo"Contrasena invalida, seras redireccionado en 5 segundos";
            header("Refresh: 5; url=index.php"); 
		   }
		   
	   }
 
        
else{
	echo"Correo existen";
            header("Refresh: 5; url=index.php");
}
 
?>

