<?php

require ('database.php');
require('config.php');

$ok=false;

if($_POST){
     
    
     $pass = 'admin';
     extract($_POST,EXTR_OVERWRITE);
}


if(isset($correo) && isset($password)){
    
   
    
    $db = new database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
     
    $validarcorreo = $db->validarDatos('correo','empleados',$correo);
   
    if($validarcorreo!=0){
    $db->preparar("select id_empleado,nombre,correo from empleados where correo ='$correo'");
    $db->ejecutar();
    $db->prep()->bind_result($id,$nombre,$dbcorreo);
    $db->resultado();
    $db->liberar();
    

        
        if($correo ==$dbcorreo){
           
             if($password == $pass){
             $ok=true;
        }
        else{
            echo"La contrasena es invalidad, por favor ingrese una valida";
            header("refresh:5; url=login.php");
        }
}
         else{
            
            echo"Correo no existe";
        }
            
        }
        else{
            echo"Correo no existe por favor ingrese uno valido";
            header("refresh:5; url=login.php");
        }
        
}
    
   






?>


<?php if($ok): ?>

<h2> Bienvenido a la administraccion <?php echo $nombre ?></h2>

<br>


<link rel="stylesheet" href="bootstrap.min.css">
<table class="table table-striped">
    
    <thead>
        <th>#</th>
        <th>Nombre</th>
         <th>Apellido</th>
          <th>Departamento</th>
           <th>Cedula</th>
           <th>Telefono</th>
           <th>Correo</th>
           <th>Acciones</th>
        
    </thead>
    
    <tbody>
        <?php
    
    
    $db->preparar("select nombre,apellido,departamento,cedula,telefono,correo from empleados");
    $db->ejecutar();
    $db->prep()->bind_result($dbnombre,$dbapellido,$dbdepartamento,$dbcedula,$dbtelefono,$dbcorreo);
    
   

        $conteo =0;
        while($db->resultado()){
        $conteo++;
            echo"<tr>
        <td>$conteo</td>
        <td>$dbnombre</td>
        <td>$dbapellido</td>
        <td>$dbdepartamento</td>
        <td>$dbcedula</td>
        <td>$dbtelefono</td>
        <td>$dbcorreo</td>
        <td>
        
          <a class='btn btn-success' href='editar.php?editar=$id'>
       <i class ='glyphicon glyphicon-pencil'></i>
         </a>
        
         <a class='btn btn-Danger' href='editar.php?eliminar=$id'>
       <i class ='
	   '></i>
         </a>
         </td>
        
       
        </tr>";
        }
        ?>
        
      
         

    </tbody>
    
    
</table>


<?php endif; ?>