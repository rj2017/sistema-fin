<?php 
include('config.php'); 
Usuario::updateUsuarioOnline();

Painel::verificarPermissaoPagina(1);
?>
<!DOCTYPE html>
<html>
<head>
	<title>D3T || Login</title>
	<html lang="pt-br">
	<meta charset="utf-8">
	<link rel="shortcut icon" href="images/shotcut.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.o, maximun-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH;?>css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH;?>css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH;?>css/style.css">
</head>
<body>
<?php include("header.php")  ?>
	
	<div class="conteudo">
	<?php

			Painel::loadPager();

	?>
	</div> 
<?php include("footer.php")  ?>
	
</body>
</html>
