<?php include "config.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>D3T || Login</title>
	<html lang="pt-br">
	<meta charset="utf-8">
	<link rel="shortcut icon" href="images/shotcut.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH;?>css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header>
		<nav class="menu">
			<a href="<?php echo INCLUDE_PATH;?>home"><img src="images/logo2.png"></a>
			<div class="dropdown">
				<span>Administrador</span>
				<div class="dropdown-content">
					<a href="<?php echo INCLUDE_PATH;?>cad_usuarios">Usuários</a>
					<a href="<?php echo INCLUDE_PATH;?>cad_grupo_usuario">Grupos de usuários</a>
				</div>
			</div>
			<div class="dropdown">
				<span>Financeiro</span>
				<div class="dropdown-content">
					<a href="">Entradas</a>
					<a href="">Saídas</a>
					<a href="">Relatórios</a>
					<a href="">Parâmetros</a>
				</div>
			</div>
			<div class="perfil"></div>
			<div class="perfil-single">
				<a href="">Perfil</a>
				<a href="">Contato</a>
				<a href="login">Sair</a>
			</div>
		</nav>
		<div class="clear"></div>
	</header>
	<section class="conteudo">
	<?php

		$url = isset($_GET['url']) ? $_GET['url'] : 'home';

		if(file_exists($url).'.php'){

			include('pages/'.$url.'.php');

		}else {
			# podemos fazer o que quiser pois a pagina não existe
			include('404.php');

		}
	?>
	</section>
	<footer>
		<div class="left"><p>Todos os direitos reservados</p></div>
		<div class="right"><p>contato@dev3tech.com.br</p></div>
		<div class="clear"></div>
	</footer>

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js" ></script>
	<script src="js/functions.js" ></script>
	

</body>
</html>