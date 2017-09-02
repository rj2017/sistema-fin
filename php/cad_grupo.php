<?php
	

	if (isset($_POST['cadastrar'])) {
		$descricao = $_POST['descricao'];

		$sql = $pdo->prepare("INSERT INTO `grupo_usuario` VALUES (null, ?, 1)");

		$sql->execute(array($descricao));

		echo "<script>alert('Grupo cadastrado com sucesso')</script>";
		
	}

?>