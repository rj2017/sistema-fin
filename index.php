
<?php

	if(isset($_GET['url'])){
		if(file_exists($_GET['url']).'.php'){
			include($_GET['url'].'.php');
		}else{
			include('404.php');
		}
	}else{
		include('login.php');
	}
?>