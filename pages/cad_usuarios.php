<!DOCTYPE html>
<html>
<head>
	<title>D3T || Login</title>
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
				<p>Tela para parâmetrisação de informações!</p>
				<input type="text" name="usuario" placeholder="usuário" required />
				<input type="password" name="senha" placeholder="senha" required/>
				<input type="password" name="senha2" placeholder="confirme a senha" required/>
				<select name="grupo" required>
					<option value="#">grupo de usuário</option>
					<option value="adm">Administrador</option>
				</select>
				<div class="wraper-btns">
					<input type="submit" name="cadastrar" value="cadastrar" />
					<input type="submit" name="pesquisar"  value="pesquisar" />
				</div>
			</form>
		</div>
	</section>

	<script src="js/jquery-3.2.1.min.js"/>
	<script src="js/bootstrap.js" />
	<script src="js/formulario.js"></script>
</body>
</html>