<?php
	if (isset($_POST['acao'])) {
		
		$descricao = $_POST['descricao'];

		$sql = $pdo->prepare("INSERT INTO `grupo_usuario` VALUES (null, ?, 1)");

		$sql->execute(array($descricao));

		echo "Cliente cadastrado com sucesso!";		
	}
?>