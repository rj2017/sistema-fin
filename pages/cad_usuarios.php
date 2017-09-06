<?php
$pdo = MySql::conectarDb();
include('php/cad_user.php');
?>
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
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="conteudo">
		<section class="cadastrar">
				<div class="wraper-form">
					<form method="post">
						<p>Tela para parâmetrisação de informações!</p>
						<input type="text" name="usuario" placeholder="usuário"  />
						<input type="password" name="senha" placeholder="senha" />
						<input type="password" name="senha2" placeholder="confirme a senha" />
						<select name="grupo" >
							<?php include("php/pree_grupo.php"); ?>
						</select>
						<div class="wraper-btns">
							<input type="submit" name="cadastrar" value="cadastrar" />
							<input type="submit" name="pesquisar"  value="pesquisar" />
						</div>
					</form>
				</div>
		</section>
		<div class="retorno">
			<div class="wraper-retorno">
				<table>
				<tr>
					<th>Id</th>
					<th>Nome</th>
					<th>Grupo usuário</th>
					<th>Ativo</th>
					<th>Excluir</th>
				</tr>
				<div class="limpar">
					<?php include("php/pesq_user.php"); ?>
				</div>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
