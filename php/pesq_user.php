<?php



if (isset($_POST['pesquisar'])) {

		$user = $_POST['usuario'];


		if ($user == '') {
			$sql = $pdo->prepare("SELECT * FROM `usuario` INNER JOIN `grupo_usuario` ON usuario.id_grupo_usuarios = grupo_usuario.id_grupo_usuario");

			$sql->execute();
			$info = $sql->fetchAll();

			foreach ($info as $key => $value) {

				$id = $value['id_usuario'];
				$user = $value['usuario'];
				$ativo = $value['ativo'];
				$grupo = $value['descricao'];


				if ($ativo == 1) {
					$ativo = 'Sim';
				}else{
					$ativo = 'Não';
				}

				echo "<tr>";
				echo '<td>'.$id.'</td>';
				echo '<td>'.$user.'</td>';
				echo '<td>'.$grupo.'</td>';
				echo '<td>'.$ativo.'</td>';
				echo "</tr>";


			}
		}



		$sql = $pdo->prepare("SELECT * FROM `usuario` INNER JOIN `grupo_usuario` ON usuario.id_grupo_usuarios = grupo_usuario.id_grupo_usuario WHERE 'usuario' = ?");

		$sql->execute(array($user));
		$info = $sql->fetchAll();
		if (isset($info)) {
			
		


		foreach ($info as $key => $value) {

			$id = $value['id_usuario'];
			$user = $value['usuario'];
			$ativo = $value['ativo'];
			$grupo = $value['descricao'];

			if ($ativo == 1) {
				$ativo = 'Sim';
			}else{
				$ativo = 'Não';
			}

			echo "<tr>";
				echo '<td>'.$id.'</td>';
				echo '<td>'.$user.'</td>';
				echo '<td>'.$grupo.'</td>';
				echo '<td>'.$ativo.'</td>';
				echo "</tr>";
		}


	}else{
		echo "<string>alert('Não foi localizado nenhuma resposta para essa pesquisa')</string>";
	}
		
}
?>