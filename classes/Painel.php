<?php
	class Painel
	{

		public static function logado(){

			return isset($_SESSION['login']) ? true : false;
		}


		public static function loggout(){
			session_destroy();
			header('location:'.INCLUDE_PATH);
		}

		public static function loadPager(){
			$url = isset($_GET['url']) ? $_GET['url'] : 'home';

			if(file_exists('pages/'.$url.'.php')){

				include('pages/'.$url.'.php');

			}else{
				# podemos fazer o que quiser pois a pagina não existe
				include('404.php');

			}
		}

		public static function updateUsuarioOnline(){
			if (isset($_SESSION['online'])) {

				$token = $_SESSION['online'];
				$horario_atual = date('Y-m-d H-i-s');

				$confirmar = MySql::conectarDb()->prepare("SELECT id FROM `tb_admin.online` WHERE token = ? ");
				$confirmar->execute(array($_SESSION['online']));

					if ($confirmar->rowCount() == 1) {
						$sql = Mysql::conectarDb()->prepare("UPDATE `tb_admin.online` SET `ultima_acao` = ? WHERE token = ? ");
						$sql->execute(array($horario_atual, $token));
					}else{
						$ip = $_SERVER['REMOTE_ADDR'];
						$_SESSION['online'] = uniqid();
						$sql = Mysql::conectarDb()->prepare("INSERT INTO `tb_admin.online` VALUES (null,?,?,?)");
						$sql->execute(array($ip , $horario_atual, $token));

					}
				

			}else{
				$ip = $_SERVER['REMOTE_ADDR'];
				$horario_atual = date('Y-m-d H-i-s');
				$_SESSION['online'] = uniqid();
				$token = $_SESSION['online'];
				$sql = Mysql::conectarDb()->prepare("INSERT INTO `tb_admin.online` VALUES (null,?,?,?)");
				$sql->execute(array($ip , $horario_atual, $token));
			}
		}

		public static function listarUsuariosOnline(){
			self::limparUsuariosOnline();

			$sql = MySql::conectarDb()->prepare("SELECT * FROM `tb_admin.online` ");
			$sql->execute();

			return $sql->fetchAll();

		}

		public static function limparUsuariosOnline(){

			$date = date('Y-m-d H-i-s');
			$sql = MySql::conectarDb()->prepare("DELETE FROM `tb_admin.online` WHERE ultima_acao < '$date' - INTERVAL 1 MINUTE ");
			$sql->execute();
		}

		public static function countUsariosAtivos(){
			$sql = MySql::conectarDb()->prepare("SELECT * FROM `tb_admin.usuario` WHERE ativo = 1 ");
			$sql->execute();

			return $sql->fetchAll();
		}

		public static function alerta($tipo,$menssagem){
			if ($tipo == 'sucesso') {
				echo '<div class="box-alerta sucesso"><i class="fa fa-check"></i>'.$menssagem.'</div>';
			}elseif ($tipo == 'erro') {
				echo "<div class='box-alerta erro'><i class='fa fa-times'></i>$menssagem</div>";
			}

		}

		public static function imagemValida($img){

			if ($img['type'] == 'image/jpeg' ||
			 $img['type'] == 'image/jpg' || 
			 $img['type'] == 'image/png'){
					
					//pegar o tamanho em kabytes
					$tamanho = intval($img['size'] / 1024);
					//verificando se a imagem e maior do que 300kb para não sobrecarregar o servidor
					if ($tamanho < 300) {
						return true;
					}else{
						return false;
					}

				
				}else{
					return false;
				}
		}

		public static function uploadFile($file){
			//função nativa do PHP que transefere o arquivo
			if (move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$file['name'])) {
				$_SESSION['img'] = $file['name'];
				return $file['name'];
			}else{
				return false;
			}
		}

		public static function deleteFile($file){

			@unlink('uploads/'.$file);
		}

		public static function selecionadoMenu($par){
		$url = explode('/', @$_GET['url'])[0];

		if ($url == $par) 
			echo 'class = "menu-active" ';

			// <i class="fa fa-angle-double-right"></i>
		}

		public static function verificarPermissaoMenu($permissao){
			if($_SESSION['permissao'] >= $permissao) {
				
				return;
			}else{

				echo 'style="display: none"';
			}
		}

		public static function verificarPermissaoPagina($permissao){
			if(@$_SESSION['permissao'] >= $permissao) {
				
				return;
			}else{

				include("pagina-proibida.php");
				die();
			}
		}


	}
?>