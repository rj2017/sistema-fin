<?php
	class Painel
	{

		public static function logado(){

			return isset($_SESSION['login']) ? true : false;
		}

		public static function logarSistema(){
			if (isset($_POST['acao'])) {

			$usuario = $_POST['login'];
			$senha = $_POST['senha'];

			$sql = MySql::conectarDb()->prepare("SELECT  a.id AS 'id-user', a.nome AS 'nome', a.senha AS 'senha', a.img AS 'img', a.permissao AS 'permissao', b.pdv AS 'pdv' FROM `tb_admin.usuario` as a INNER JOIN `tb_fin.usuario-pdv` as b ON a.id = b.usuario WHERE a.usuario = ? and a.senha = ? and a.ativo = '1'");

			$sql->execute(array($usuario,$senha));

			if ($sql->rowCount() == 1) {

				$info = $sql->Fetch();

				$_SESSION['login'] = true;
				$_SESSION['id'] = $info['id-user'];
				$_SESSION['user'] = $usuario;
				$_SESSION['nome'] = $info['nome'];
				$_SESSION['senha'] = $info['senha'];
				$_SESSION['img'] = $info['img'];
				$_SESSION['permissao'] = $info['permissao'];
				$_SESSION['pdv'] = $info['pdv'];

				if (isset($_POST['lembrar'])) {
					setcookie('lembrar',true, time()+(60*60*24));
					setcookie('user',$_SESSION['user'],  time()+(60*60*24));
					setcookie('senha', $_SESSION['senha'],  time()+(60*60*24));
				}
				header('location:'.INCLUDE_PATH);
				die();
			}else{
				self::alerta('erro','Usuário não cadastrado!');

				}
			}
		}


		public static function loggout(){
			setcookie('lembrar',true, time()-2);
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
			$formatoArquivo = explode('.', $file['name']);
			$imagemNome = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1 ];
			
			//função nativa do PHP que transefere o arquivo
			if (move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$imagemNome)) {

				
				return $imagemNome;
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

		public static function delete($tabela, $id=false){

			if ($id == false) {
				$sql = MySql::conectarDb()->prepare("DELETE FROM `$tabela`");
			}else{
				$sql = MySql::conectarDb()->prepare("DELETE FROM `$tabela` WHERE id = $id");
			}

			if($sql->execute())
				self::alerta('sucesso','Item excluído com sucesso');
			else
				self::alerta('erro','Ocorreu um erro na exclusão gentileza verificar');

		}

		public static function redirect($url){
			echo '<script>window.setTimeout(location.href="'.$url.'",3000)</script>';
			die();
		}

		//metodo especifico para selecionar apenas um registro

		public static function select($tabela, $query, $arr){

			$sql = MySql::conectarDb()->prepare("SELECT * FROM `$tabela` WHERE $query ");
			$sql->execute($arr);

			return $sql->fetch();
		}

		



	}
?>