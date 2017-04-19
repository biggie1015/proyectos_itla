<?php

require ('database.php');
require('config.php');
$ok=false;
    

if($_POST){
     
    extract($_POST,EXTR_OVERWRITE);
  
}


if(isset($nombre)  && $apellido && $departamento && $cedula && $telefono && $correo){
    
    $db = new database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
     
    $validarcorreo = $db->validarDatos('correo','empleados',$correo);
    
    if($validarcorreo==0){
        
        if($db->preparar("insert into empleados values(null,'$nombre','$apellido','$departamento',$cedula,$telefono,'$correo')")){
            
            $db->ejecutar();
            $ok = true;
            
            
        }
        else{
            echo"Error al registrarse";
        }
        
        
    }
    else{
        echo"Email existente";
    }
} 
else{
    
}





?>


<?php if($ok) : ?>

<h2>Saludos <?php echo $nombre ?></h2>

<link rel="stylesheet" href="bootstrap.min.css">

<p>Por favor pulsa el boton <strong>LOGUEAR</strong> para que puedas inicar seccion.</p>

<a  class="btn btn-primary" href="login.php">Loguear</a>

<?php else : ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  
  <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <center>
    
    <h2>Registro</h2>
    <br>
    <form class="for-inline" action="" method="POST">
       
       <div class="input-group">
       <input class="form-control" type="text" name="nombre" placeholder="Nombre">
       <br>
       </div>
       <br>
       
       <div class="input-group">
       <input class="form-control" type="text" name="apellido" placeholder="Apellido">
       <br>
        </div>
        <br>
       
       <div class="input-group">
       <input class="form-control" type="text" name="departamento" placeholder="Departamento">
       <br>
        </div>
        <br>
       
       <div class="input-group">
       <input class="form-control" type="text" name="cedula" placeholder="Cedula">
       <br>
        </div>
        <br>
       
       <div class="input-group">
       <input class="form-control" type="text" name="telefono" placeholder="Telefono">
       <br>
        </div>
        <br>
       
       <div class="input-group">
       <input class="form-control" type="text" name="correo" placeholder="Correo">
       <br>
        </div>
        <br>
       

        <button class="btn btn-primary">Registrar</button>
        <br>
        <a href="login.php"> Logging</a>
        
    </form>
    
    </center>
    <?php endif; ?>
</body>
</html>