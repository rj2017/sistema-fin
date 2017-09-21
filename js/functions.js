
$(function(){
		
		$('.perfil').click(function(){

			$('.perfil-single').slideToggle();
		});

		$('form').submit(function(){

			$('.limpar').html("");
			
		});

		$('.btn-pesq').click(function(){
			$('.pesquisar-usuario').slideToggle();
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

});