<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form name="f1">
Nombre: <input type="text" name="nombre">
<br>
<input type="checkbox" name="ch1"> Opcion 1
<br>
<input type="checkbox" name="ch2"> Opcion 2
<br>
<input type="checkbox" name="ch3"> Opcion 3
<br>
<input type="checkbox" name="ch4"> Opcion 4
<br>
<a href="javascript:seleccionar_todo()">Marcar todos</a> 
<br>
<input type="submit">

	<script>
	function seleccionar_todo(){
   for (i=0;i<document.f1.elements.length;i++)
      if(document.f1.elements[i].type == "checkbox")
         document.f1.elements[i].checked=1
} 
</script>
</form>

<?php
	
	if(isset($_POST['che2'] && isset($_POST['che1'] && isset($_POST['che3'] )){
		
	}
	?>
</body>
</html>