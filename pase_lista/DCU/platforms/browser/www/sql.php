<?php


   $conexion = mysqli_connect("localhost","ismel","ismel","ismel");
    $correo = $_POST['email'];
$pass = $_POST['pass'];
$sql = "INSERT INTO pruobar (null,'nombre') VALUES ('$correo')";

$resultado = mysqli_query($conexion,$sql);



?>