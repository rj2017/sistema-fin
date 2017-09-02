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

<?php include("header.php")  ?>
	<section class="cadastrar">
		<div class="wraper-form">
			<form method="post">
				<p>Cadastrar ou pesquisar grupos de usuários</p>
				<input type="text" name="descricao" placeholder="nome" required />
				<div class="wraper-btns">
						<input type="submit" name="cadastrar" value="cadastrar" />
						<input type="submit" name="pesquisar"  value="pesquisar" />
					</div>
			</form>
		</div>
	</section>
</section>

<?php include("footer.php")  ?>

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/functions.js"></script>
	<script src="js/formulario.js"></script>
	
</body>
</html>
