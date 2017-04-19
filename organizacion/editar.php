 <?php 


require ('database.php');
require('config.php');

if(isset($_GET['editar'])){ 
   

 $gid=$_GET['editar'];
}

    $db = new database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
     
    $db->preparar("select nombre,apellido,departamento,cedula,telefono,correo from empleados where id_empleado =?");
    $db->prep()->bind_param('i',$gid);
    $db->ejecutar();
    $db->prep()->bind_result($dbnombre,$dbapellido,$dbdepartamento,$dbcedula,$dbtelefono,$dbcorreo);
    $db->resultado();



    ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  
  <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <center>
    <h2>Editar Usuarios</h2>
   
    <br>
      <form class="for-inline" action="actualizar.php" method="POST">
       
        <div class="input-group">
       <input class="form-control" type="text" name="nombre" placeholder="<?php echo $dbnombre;?>">
       <br>
       </div>
       <br>
       
       <div class="input-group">
       <input class="form-control" type="text" name="apellido" placeholder="<?php echo $dbapellido;?>">
       <br>
        </div>
        <br>
       
       <div class="input-group">
       <input class="form-control" type="text" name="departamento" placeholder="<?php echo $dbdepartamento;?>">
       <br>
        </div>
        <br>
       
       <div class="input-group">
       <input class="form-control" type="text" name="cedula" placeholder="<?php echo $dbcedula;?>">
       <br>
        </div>
        <br>
       
       <div class="input-group">
       <input class="form-control" type="text" name="telefono" placeholder="<?php echo $dbtelefono;?>">
       <br>
        </div>
        <br>
       
       <div class="input-group">
       <input class="form-control" type="text" name="correo" placeholder="<?php echo $dbcorreo;?>">
       <br>
       <div class="input-group">
       <input class="form-control" type="hidden" name="ids" placeholder="<?php echo $gid;?>">
       <br>
       <button class="btn btn-primary">Actualizar</button>
        </div>
        <br>
        
</form>