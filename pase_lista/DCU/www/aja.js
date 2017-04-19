
		$(function(){
	
var $boton = $('#enviar'),
	$form = $('#formu');
	
	$boton.on('click',function(){
		
		var datos= $form.serialize(),
			url= 'otro.html';
		$.ajax({
			
			type:"POST",
			url:url,
			data:datos,
			datatype:'json',
			success:function(data){
				alert (data);
			}
			error:function(e){
				
			console.log(e);  
			 
		}
			 
		});
			
		});
		
		
		
		
	});
