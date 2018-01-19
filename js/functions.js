
$(function(){
		
		$('.perfil').click(function(){

			$('.perfil-single').slideToggle();
		});

		$('form').submit(function(){

			$('.limpar').html("");
			
		});

		$('.btn-pesq').click(function(){
			$('.pesquisar-item').slideToggle();
		});

		//confirmar antes de deletar
		$('[activeBtn = delete]').click(function(){
			var txt;
			var r = confirm('Deseja excluir o registro?');

			if (r == true) {

				return true;
			}else{
				return false;
			}
		});

		$('#date').mask('11/11/1111');
		$('#time').mask('00:00:00');
		$('#date_time').mask('00/00/0000 00:00:00');
		$('#cep').mask('00000-000');
		$('#phone').mask('0000-0000');
		$('#phone_with_ddd').mask('(00) 0000-0000');
		$('#phone_us').mask('(000) 000-0000');
		$('#mixed').mask('AAA 000-S0S');
		$('#cpf').mask('000.000.000-00', {reverse: true});
		$('#money').mask('000000000.00', {reverse: true});


		/*ação de preenchimento de select*/

		  $('#tipo').change(function(){

	    	if( $(this).val() ) { 


		    	$.ajax({
		    		url: 'http://127.0.0.1/projects/sistema_fin/buscar.php',
		    		type: 'POST',
		    		dataType: 'json',
		    		data: {tipo: $(this).val()},
		    	})
		    	.done(function(tipo) {

		    		var retorno = '<option value="">-- Escolha um sub-tipo --</option>';

		    		for (var i = tipo.length - 1; i >= 0; i--) {

		    			var id = tipo[i]['id'];
		    			var descricao = tipo[i]['descricao'];

		    			retorno += '<option value='+ id +'>'+ descricao +'</option>';
		    		}

		    		$('#sub-tipo').html(retorno);
		    		
		    	})
		    	.fail(function() {
		    		/*console.log("error");*/
		    	})
		    	.always(function() {
		    		/*console.log("complete");
*/
		    	});
		    	

		    } else {
		      $('#sub-tipo').html('<option value="">-- Escolha um sub-tipo --</option>');
		    }
		  });

/*entradas e saidas*/


		  $('#quantidade').change(function(){
		  	
		  	var qtn = $('#quantidade').val();
		  	var desc = parseFloat($('.desconto').val());
		  	var vlr = parseFloat($('#valor').val());

		  	

			desc = desc.toFixed(2);
		  	vlr = vlr.toFixed(2);


		  	var total = ( qtn * vlr - desc).toFixed(2);

		  	$('.total').val(total);

		  });

		  $('.desconto').keyup(function() {

		  	var qtn = $('#quantidade').val();
		  	var desc = parseFloat($('.desconto').val());
		  	var vlr = parseFloat($('#valor').val());


		  	vlr = vlr.toFixed(2);
		  	desc = desc.toFixed(2);

		  	var total = ( qtn * vlr - desc).toFixed(2);;

		  	$('.total').val(total);
		  });
					

});