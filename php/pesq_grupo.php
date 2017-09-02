<?php

$sql = $pdo->prepare("SELECT * FROM `grupo_usuario`");

		$sql->execute();
		$info = $sql->fetchAll();

		foreach ($info as $key => $value) {

			$id = $value['id_grupo_usuario'];
			$desc = $value['descricao'];
			$ativo = $value['ativo'];

			if ($ativo == 1) {
				$ativo = 'Sim';
			}else{
				$ativo = 'Não';
			}

			echo "<tr>";
			echo '<td>'.$id.'</td>';
			echo '<td>'.$desc.'</td>';
			echo '<td>'.$ativo.'</td>';
			echo '<td><i class="fa fa-times" aria-hidden=
			"true" value="'.$id.'"></i></td>';
			echo "</tr>";


		}


if (isset($_POST['pesquisar'])) {
		$descricao = $_POST['descricao'];
		$ativo = $_POST['ativo'];


		$sql = $pdo->prepare("SELECT * FROM `grupo_usuario` WHERE `descricao` = ? AND `ativo` = ? ");

		$sql->execute(array($descricao,$ativo));
		$info = $sql->fetchAll();
		if (isset($info)) {
			
		

		if ($ativo == 1) {
				$ativo = 'Sim';
			}else{
				$ativo = 'Não';
			}

		foreach ($info as $key => $value) {

			$id = $value['id_grupo_usuario'];
			$desc = $value['descricao'];
			$ativo = $value['ativo'];

			echo "<tr>";
			echo '<td>'.$id.'</td>';
			echo '<td>'.$desc.'</td>';
			echo '<td>'.$ativo.'</td>';
			echo '<td><i class="fa fa-times" aria-hidden=
			"true" value="'.$id.'"></i></td>';
			echo "</tr>";

		}

	}else{
		echo "<string>alert('Não foi localizado nenhuma resposta para essa pesquisa')</string>";
	}
		
}
?>