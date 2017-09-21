<?php
if (isset($_COOKIE['lembrar'])) {
	@$usuario = $_COOKIE['user'];
	@$senha = $_COOKIE['senha'];

	$sql = MySql::conectarDb()->prepare("SELECT * FROM `tb_admin.usuario` WHERE `usuario` = ? and `senha` = ? and `ativo` = '1'");
	$sql->execute(array($usuario,$senha));
	if ($sql->rowCount() == 1) {
		$info = $sql->Fetch();

		$_SESSION['login'] = true;
		$_SESSION['user'] = $usuario;
		$_SESSION['nome'] = $info['nome'];
		$_SESSION['senha'] = $info['senha'];
		$_SESSION['img'] = $info['img'];
		$_SESSION['permissao'] = $info['permissao'];
		header('location:'.INCLUDE_PATH);
		die();
	}
}


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
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH;?>css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH;?>css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH;?>css/style.css">
</head>
<body>
	<section class="login">
		
			<div class="wraper-login">

			<?php
				Painel::logarSistema();
				
			?>
				<p>Gentileza digite seu login e senha para acessar o sistema.</p>
				<form method="post">
					<input type="text" placeholder="Login" name="login" required />
					<input type="password"  placeholder="senha" name="senha" required />
					
					<div class="form-group-login">
						<label>Lembrar-me</label>
						<input type="checkbox" name="lembrar" />
					</div>
					<input class="btn btn-default" type="submit" name="acao">


					<!-- <div class="text-right"><a>Esqueci a senha</a></div> -->
					<div class="clear"></div>
				</form>
			</div><!-- wraper-login -->
	<img src="images/logo.png">
	</section>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js" ></script>

</body>
</html>