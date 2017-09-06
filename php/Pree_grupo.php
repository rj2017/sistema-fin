<?php

$sql = $pdo->prepare("SELECT * FROM `grupo_usuario` WHERE ativo = 1 ");

$sql->execute();

$info = $sql->fetchAll();



foreach ($info as $key => $value) {

$id = $value['id_grupo_usuario'];
$descricao = $value['descricao'];

	echo '<option value='.$id.'>'.$descricao.'</option>';


}
?>