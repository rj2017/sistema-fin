
$(function(){
		
		$('.perfil').click(function(){

			$('.perfil-single').slideToggle();
		});

		$('form').submit(function(){

			$('.limpar').html("");
			
		});

		//fa fa-times
		//fa fa-bars
/*		carregarDinamico();

		function carregarDinamico(){

			$('[realtime]').click(function(){

				var pagina = $(this).attr('realtime');

				$('section.conteudo').html('');

				$('section.conteudo').load('/projects/sistema_fin/pages/'+pagina+'.php');
				return false;
			});
		}*/
});