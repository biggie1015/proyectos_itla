<?php session_start(); ?>



<?php
require('database.php');
require('config.php');

if($_POST){
	
	extract($_POST,EXTR_OVERWRITE);
	
	
}

if(isset($email) && isset($pass)){
	$outpo[];
	  $db = new database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
     
   
   
 
    $db->preparar("SELECT id_profesor,correo,contrasena
	               FROM profesor
	 			   WHERE correo = '$email'");
		
    $db->ejecutar();
    $db->prep()->bind_result($id,$dbcorreo,$dbcontrasena);
    $db->resultado();
    $db->liberar();
  
	  
       if($email ==$dbcorreo){
           
		   
           if($pass == $dbcontrasena){
			   $_SESSION['idprofesor']=$id;
			   $_SESSION['emial']=$email;
			   
			    $terminar =time()+365*24*60*60;
			   
			   if($recordar=='activo'){
				   setcookie('id', $_SESSION['idprofesor'],$terminar);
				    setcookie('email', $_SESSION['email'],$terminar);
			   }
			   
			  
			   $db->cerrar();
		   }  
	   }else{
		   $outpo=["error"=>true,"tipoError"=>"Contrasena invalida, seras redireccionado en 5 segundos"];
		   }
		   c
	   }
 
        
else{
	$outpo=["error"=>true,"tipoError"=>"Correo no existe"];
            
}

$json = json_encode($outpo);
echo $json;
 
?>
