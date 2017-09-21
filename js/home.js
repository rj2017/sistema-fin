$(function(){
	
	var open = true;
	var windowSize = $(window)[0].innerWidth;
	$(window).resize(function() {
		windowSize = $(window)[0].innerWidth;
	});
	var targetSizeMenu = (windowSize <= 480 ? 200 : 300);

	if (windowSize <= 768) {
		open = false;
	}

	$('.menu-btn i').click(function() {

		if (open) {
			//menu aberto, precisamos fechar
			$('.menu-aside').animate({'width': '0'},function(){
				open = false;
			});
			$('.conteudo, header, footer').css("width","100%");
			$('.conteudo, header, footer').animate({'left' : '0'},function(){
				open = false;
			});

		}else{
			//o menu esta fechado
			$('.menu-aside').css('display','block');
			$('.menu-aside').animate({'width': targetSizeMenu+'px'},function(){
				open = true;
			});
			if (windowSize > 768) {
				$('.conteudo, header, footer').css('width','calc(100% - '+targetSizeMenu+'px)');
			}
			$('.conteudo, header, footer').animate({'left' : targetSizeMenu+'px'},function(){
				open = true;
			});
		}
		console.log(windowSize);
	});


});