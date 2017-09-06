<?php
include ("config.php");

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
				$pdo = MySql::conectarDb();
				include ("php/logar.php");
			?>
				<p>Gentileza digite seu login e senha para acessar o sistema.</p>
				<form method="post">
					<input type="text" placeholder="Login" name="login" required />
					<input type="password"  placeholder="senha" name="senha" required />
					
					<input class="btn btn-default" type="submit" name="acao">
					<div class="text-right"><a>Esqueci a senha</a></div>
					<div class="clear"></div>
				</form>
			</div><!-- wraper-login -->
	<img src="images/logo.png">
	</section>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js" ></script>

</body>
</html>