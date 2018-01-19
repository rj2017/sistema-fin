<?php 
include('config.php'); 
header('Content-type: text/json');

$retorno = array();

$tipo = $_POST['tipo'];

$subtipo = Financeiro::selectSubParametro($tipo);



foreach ($subtipo as $key => $value) {

		$id = $value['id'];
		$descricao = $value['descricao'];

		

}

echo json_encode($subtipo);


?>