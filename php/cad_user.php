<?php 
if (isset($_POST['cadastrar'])) {

		$user = $_POST['usuario'];
		$senha = $_POST['senha'];
		$grupo = $_POST['grupo'];

		$sql = $pdo->prepare("INSERT INTO `usuario` VALUES (null, ?, ?,1,?)");

		$sql->execute(array($user,$senha,$grupo));

		echo "<script>alert('Usuário cadastrado com sucesso')</script>";
		
	}

?>