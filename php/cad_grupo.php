<?php
	

	if (isset($_POST['cadastrar'])) {
		$descricao = $_POST['descricao'];
		$ativo = $_POST['ativo'];

		$sql = $pdo->prepare("INSERT INTO `grupo_usuario` VALUES (null, ?, ?)");

		$sql->execute(array($descricao,$ativo));

		echo "<script>alert('Grupo cadastrado com sucesso')</script>";
		
	}

?>