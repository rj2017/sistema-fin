<?php

/*a fazer
configurar o usuário ao PDV
colocar o id do Pdv do usuário na sessao
*/

	@session_start();
	date_default_timezone_set('America/Sao_Paulo');	
	require('vendor/autoload.php');


	$autoload = function($class){
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);

	@define('INCLUDE_PATH','http://127.0.0.1/projects/sistema_fin/');
	@define('BASE_DIR_PAINEL',__DIR__);
	
	//Conectar ao banco de dados
	@define('HOST', 'localhost');
	@define('DB', 'sistema_financeiro');
	@define('USER', 'root');
	@define('PASS', '');

	//funções do painel

	


?>