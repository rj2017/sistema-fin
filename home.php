<?php include("config.php"); ?>
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
<?php include("header.php")  ?>
	
	<div class="conteudo">
<!-- 	<?php

			$url = isset($_GET['url']) ? $_GET['url'] : 'home';

			if(file_exists('pages/'.$url.'.php')){

				include('pages/'.$url.'.php');

			}else{
				# podemos fazer o que quiser pois a pagina não existe
				include('404.php');

			}
	?>-->
	</div> 
<?php include("footer.php")  ?>
	
</body>
</html>