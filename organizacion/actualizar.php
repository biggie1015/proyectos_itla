 <?php

require ('database.php');
require('config.php');

if(isset($_POST['ids'])){
    
  extract($_POST,EXTR_OVERWRITE);
    
    $db = new database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    
    
   
     $db->preparar("UPDATE empleados
                            set  nombre=?,
                            apellido=?,
                            departamento=?,
                            cedula=?,
                            telefono=?,
                            correo=? 
                            where id_empleado = ? ");
$db->prep()->bind_param('sssiisi',$nombre,$apellido,$departamento,$cedula,$telefono,$correo,$ids); 
    $db->ejecutar();
    $db->liberar();

$ok = "Actualizacion corerecta";
header("Refresh:5;url=admin.php");

    }

else{
   $ok = "error";
}


echo "$ok<br>";
?>







    