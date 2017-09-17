<?php

	if (isset($_POST['acao'])) {

		$usuario = $_POST['login'];
		$senha = $_POST['senha'];

		$sql = MySql::conectarDb()->prepare("SELECT * FROM `tb_admin.usuario` WHERE `usuario` = ? and `senha` = ? and `ativo` = '1'");

		$sql->execute(array($usuario,$senha));

		if ($sql->rowCount() == 1) {

			$info = $sql->Fetch();

			$_SESSION['login'] = true;
			$_SESSION['user'] = $usuario;
			$_SESSION['nome'] = $info['nome'];
			$_SESSION['senha'] = $info['senha'];
			$_SESSION['img'] = $info['img'];
			$_SESSION['permissao'] = $info['permissao'];
			header('location:'.INCLUDE_PATH);
			die();
		}else{
			echo '<div class="erro-box"><i class="fa fa-times"></i>usuário não cadastrado!</div>';

		}
	}
?>