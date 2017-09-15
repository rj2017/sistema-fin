<?php

	@session_start();
	date_default_timezone_set('America/Sao_Paulo');

	$autoload = function($class){
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);

	@define('INCLUDE_PATH','http://127.0.0.1/projects/sistema_fin/');
	
	//Conectar ao banco de dados
	@define('HOST', 'localhost');
	@define('DB', 'sistema_financeiro');
	@define('USER', 'root');
	@define('PASS', '');


?>