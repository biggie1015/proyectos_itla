<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="jquery.js"></script>
</head>
<body>

	<input type="text" name="caja_texto" id="valor1" value="0"/> 
 
 
Introduce valor 2
 
<input type="text" name="caja_texto" id="valor2" value="0"/>
 
Realiza suma
 
<input type="button" href="javascript:;" onclick="realizaProceso($('#valor1').val(), $('#valor2').val());" value="Calcula"/>
 
<br/>
 
Resultado: <span id="resultado">0</span>
<script>
	function realizaProceso(valorCaja1, valorCaja2){
        var parametros = {
                "valorCaja1" : valorCaja1,
                "valorCaja2" : valorCaja2
        };
        $.ajax({
                data:  parametros,
                url:   'prueba.php',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success: $(location).attr('href','');
                }
        });
}
	</script>
</body>
</html>