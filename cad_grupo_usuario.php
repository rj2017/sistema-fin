<?php
	include "php/conexao_banco.php";
	include "php/cad_grupo.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>D3T || cadastrar Grupo de usuários</title>
	<html lang="pt-br">
	<meta charset="utf-8">
	<link rel="shortcut icon" href="images/shotcut.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<section class="cadastrar">
		<form method="post">
			<input type="text" name="descricao" placeholder="nome" required />
			<input type="submit" value="Enviar" name="acao"/>
		</form>
	</section>

	<script src="js/jquery-3.2.1.min.js"/>
	<script src="js/bootstrap.js" />
</body>
</html>