$(function(){


	$('body').on('submit','form', function(){

		var form = $(this);
		$.ajax({
			
			url: 'ajax/cad_grupo_usuario.php',
			method:'post',
			dataType: 'json',
			data:form.serialize()

		}).done(function(data){
			if (data.sucesso) {
			console.log("retorno feito con sucesso");
			}else{
				console.log("retorno feito con sucesso,porem deu erro");
			}
		});

		return false;
	});
});