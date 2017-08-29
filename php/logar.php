<?php
	/*if (isset($_POST['acao'])) {
		$usuario = $_POST['login'];
		$senha = $_POST['senha'];

		$sql = $pdo->prepare("SELECT * FROM `usuario` WHERE 'usuario' = ? and 'senha' = ? and 'ativo' = 1");
		$sql->execute(array($usuario,$senha));
		$info = $sql->fetchAll();

		if (isset($info)) {
			header("location:home");
		}else if($info == 'array()'){
			echo "<script>alert('usuário não cadastrado!')</script>";

		}
	}*/
?>