<?php
	include("../config.php");
	include ("../php/conexao_banco.php");

		$data = array();

	if (isset($_POST['cadastrar'])){
		

		$descricao = $_POST['descricao'];

		$sql = $pdo->prepare("INSERT INTO `grupo_usuario` VALUES (null, ?, 1)");

		$sql->execute(array($descricao));

		$data['retorno'] = 'sucesso'; 	
	}

/*	die(json_encode($data));*/
?>