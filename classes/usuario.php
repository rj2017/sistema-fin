<?php

class Usuario{

	public function atualizarUsuarioPerfil($nome, $senha, $img){

		$sql = MySql::conectarDb()->prepare("UPDATE `tb_admin.usuario` SET nome = ?, senha = ?, img = ? WHERE usuario = ?");
		if ($sql->execute(array($nome,$senha,$img,$_SESSION['user']))) {

			$_SESSION['nome'] = $nome;
			
			return true;
		}else{

			return false;
		}

	}
}

?>