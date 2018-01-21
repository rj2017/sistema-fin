<?php

class Usuario{

	public function atualizarUsuarioPerfil($nome, $senha, $img){

		$sql = MySql::conectarDb()->prepare("UPDATE `tb_admin.usuario` SET nome = ?, senha = ?, img = ? WHERE usuario = ?");
		if ($sql->execute(array($nome,$senha,$img,$_SESSION['user']))) {

			$_SESSION['nome'] = $nome;
			
			return true;
		}else{

			return false;
		}

	}

	public static function editarPerfil(){
		if (isset($_POST['acao'])) {
					

					$usuario = new Usuario();

					$nome = $_POST['nome'];
					$senha = $_POST['senha'];
					$img = $_FILES['imagem'];
					$img_atual = $_POST['imagem_atual'];

					if ($img['name'] != '') {
						//existe upload de imagem
						
						if (Painel::imagemValida($img)) {

							Painel::deleteFile($img_atual);
							$img = Painel::uploadFile($img);
							$_SESSION['img'] = $img;


								if ($usuario->atualizarUsuarioPerfil($nome,$senha,$img)) {
								//se a atualização der certo

								Painel::alerta('sucesso','Atualizado com sucesso!');
								
								}else{
									//se a atualização não der certo
									Painel::alerta('erro','Ocorreu um erro ao atualizar!');
								}

						}else{
							Painel::alerta('erro','O formato da imagem não é valido!');
						}

					}else{
						//não existeupload de imagem

						$img = $img_atual;
						if ($usuario->atualizarUsuarioPerfil($nome,$senha,$img)) {
							//se a atualização der certo

							Painel::alerta('sucesso','Atualizado com sucesso!');
							
						}else{
							//se a atualização não der certo
							Painel::alerta('erro','Ocorreu um erro ao atualizar!');
						}
					}
				}
	}

	public static function updateUsuarioOnline(){
			if (isset($_SESSION['online'])) {

				$token = $_SESSION['online'];
				$horario_atual = date('Y-m-d H-i-s');

				$confirmar = MySql::conectarDb()->prepare("SELECT id FROM `tb_admin.online` WHERE token = ? ");
				$confirmar->execute(array($_SESSION['online']));

					if ($confirmar->rowCount() == 1) {
						$sql = MySql::conectarDb()->prepare("UPDATE `tb_admin.online` SET `ultima_acao` = ? WHERE token = ? ");
						$sql->execute(array($horario_atual, $token));
					}else{

						$usuario = $_SESSION['user'];
						$ip = $_SERVER['REMOTE_ADDR'];
						$_SESSION['online'] = uniqid();
						$sql = MySql::conectarDb()->prepare("INSERT INTO `tb_admin.online` VALUES (null,?,?,?,?)");
						$sql->execute(array($usuario, $ip , $horario_atual, $token));

					}
				

			}else{
				$ip = $_SERVER['REMOTE_ADDR'];
				$horario_atual = date('Y-m-d H-i-s');
				$usuario = $_SESSION['user'];
				$_SESSION['online'] = uniqid();
				$token = $_SESSION['online'];
				$sql = MySql::conectarDb()->prepare("INSERT INTO `tb_admin.online` VALUES (null,?,?,?,?)");
				$sql->execute(array($usuario, $ip , $horario_atual, $token));
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

		public static function countPdvs(){
			$sql = MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.pdv` WHERE ativo = 1 ");
			$sql->execute();

			return $sql->fetchAll();
		}


		public static function cadastrarUsuario(){
			if (isset($_POST['cadastrar'])) {


					$usuario = $_POST['usuario'];
					$nome = $_POST['nome'];
					$senha = $_POST['senha'];
					$permissao = $_POST['permissao'];
					$ativo = $_POST['ativo'];

					if ($usuario == '') {
						Painel::alerta('erro','O campo Usuário está vazio!');
					}elseif ($nome == '') {
						Painel::alerta('erro','O campo Nome está vazio!');
					}elseif ($senha == '') {
						Painel::alerta('erro','O campo Senha está vazio!');
					}else{

						if ($permissao > $_SESSION['permissao']) {

							Painel::alerta('erro','Você precisa selecionar uma permissão menor que a sua!');
						}elseif (self::userExist($usuario)) {
							Painel::alerta('erro','O Usuário '.$usuario.' já foi cadastrado!');
						}else{
							//podemos cadastrar

							$sql = MySql::conectarDb()->prepare("INSERT INTO `tb_admin.usuario` VALUES (null, ?,?,?,?,?,'')");
							$sql->execute(array($usuario,$nome,$senha,$permissao,$ativo));

							Painel::alerta('sucesso', 'Usuário cadastrado com sucesso!');
							@Painel::redirect(INCLUDE_PATH.'cad_usuarios');
						}

					}

			}


		}

		public static function cadastrarPdv(){
			if (isset($_POST['cadastrar'])) {


					$nome = $_POST['nome'];
					$ativo = $_POST['ativo'];

					if ($nome == '') {
						Painel::alerta('erro','O campo Usuário está vazio!');
					}else{
							//podemos cadastrar

							$sql = MySql::conectarDb()->prepare("INSERT INTO `tb_fin.pdv` VALUES (null, ?,?)");
							$sql->execute(array($nome,$ativo));

							Painel::alerta('sucesso', 'PDV cadastrado com sucesso!');
							@Painel::redirect(INCLUDE_PATH.'cad_pdv');

					}

			}


		}


		public static function userExist($usuario){

			$sql = MySql::conectarDb()->prepare('SELECT `id` FROM `tb_admin.usuario` WHERE `usuario` = ?');
			$sql->execute(array($usuario));

			if ($sql->rowCount() == 1) {
				return true;
			}else{
				return false;
			}
		}


		public static function selectAll($tabela,$start = null, $end = null){

			if ($start == null && $end == null)
				$sql = MySql::conectarDb()->prepare("SELECT * FROM `$tabela` ");
			else
				$sql = MySql::conectarDb()->prepare("SELECT * FROM `$tabela` LIMIT $start,$end");

			
			
			$sql->execute();
			return $sql->fetchAll();

		}

		public static function pesquisarUsuarios($start = null, $end = null){

			if ($start == null && $end == null){
				if (isset($_POST['pesquisar'])) {
					
					$usuario = $_POST['usuario'];
					$ativo = $_POST['ativo'];
					$permissao = $_POST['permissao'];

					if ($usuario == '') {

						if ($permissao == '0') {
								$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_admin.usuario` WHERE `ativo` = ?");
								$sql->execute(array($ativo));

								return $sql->fetchAll();
						}else{

						$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_admin.usuario` WHERE `permissao` = ? AND  `ativo` = ?");
						$sql->execute(array($permissao,$ativo));

						return $sql->fetchAll();

						}	

					}elseif ($usuario != '') {

						if ($permissao == 0) {
								$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_admin.usuario` WHERE `usuario` = ? AND `ativo` = ?");
								$sql->execute(array($usuario,$ativo));

								return $sql->fetchAll();
						}else{
						$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_admin.usuario` WHERE `usuario` = ? AND `ativo` = ? AND `permissao` = ?");
						$sql->execute(array($usuario, $ativo , $permissao));

						return $sql->fetchAll();
						}
						
					}

				}
		}else{
				if (isset($_POST['pesquisar'])) {
					
					$usuario = $_POST['usuario'];
					$ativo = $_POST['ativo'];
					$permissao = $_POST['permissao'];

					if ($usuario == '') {

						if ($permissao == 0) {
								$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_admin.usuario` WHERE `ativo` = ? LIMIT $start,$end");
								$sql->execute(array($ativo));

								return $sql->fetchAll();
						}else{

						$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_admin.usuario` WHERE `permissao` = ? AND  `ativo` = ? LIMIT $start,$end");
						$sql->execute(array($permissao,$ativo));

						return $sql->fetchAll();

						}	

					}elseif ($usuario != '') {

						if ($permissao == '0') {
								$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_admin.usuario` WHERE  `usuario` = ? AND `ativo` = ? LIMIT $start,$end");
								$sql->execute(array($usuario, $ativo));

								return $sql->fetchAll();
						}else{
						$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_admin.usuario` WHERE `usuario` = ? AND `ativo` = ? AND `permissao` = ? LIMIT $start,$end");
						$sql->execute(array($usuario, $ativo , $permissao));

						return $sql->fetchAll();
						}
						
					}

				}
			}
		}

		public static function pesquisarPdv($start = null, $end = null){

			if ($start == null && $end == null){
				if (isset($_POST['pesquisar'])) {
					
					$nome = $_POST['nome'];
					$ativo = $_POST['ativo'];

					if ($nome == '') {


						$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.pdv` WHERE `ativo` = ?");
						$sql->execute(array($ativo));

						return $sql->fetchAll();	

					}elseif ($nome != '') {

						$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.pdv` WHERE `nome` = ? AND `ativo` = ?");
						$sql->execute(array($nome, $ativo));

						return $sql->fetchAll();
						
					}

				}
			}else{
				if (isset($_POST['pesquisar'])) {
					
					$nome = $_POST['nome'];
					$ativo = $_POST['ativo'];

					if ($nome == '') {

						$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.pdv` WHERE `ativo` = ? LIMIT $start,$end");
						$sql->execute(array($ativo));

						return $sql->fetchAll();

					}elseif ($nome != '') {

						$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.pdv` WHERE `nome` = ? AND `ativo` = ? LIMIT $start,$end");
						$sql->execute(array($usuario, $ativo));

						return $sql->fetchAll();
						
						
					}

				}
			}
		}

		public static function pesquisarPdvUsuario($start = null, $end = null){

			if ($start == null && $end == null){
				if (isset($_POST['pesquisar'])) {
					
					$user = $_POST['usuario'];
					$pdv = $_POST['pdv'];

					if ($user == '' ||  $pdv == '') {


						if ($user == '' &&  $pdv == '') {

							Painel::alerta('erro','gentileza colocar pelo menos um parametro para realizar a buscar');
						}

						$sql= MySql::conectarDb()->prepare("SELECT fup.id AS id, fup.usuario AS usuario, fup.pdv AS pdv, fp.nome AS 'nome-pdv', au.nome AS 'nome-usuario', au.usuario AS 'user' FROM `tb_fin.usuario-pdv` AS fup INNER JOIN `tb_fin.pdv` AS fp ON fup.pdv = fp.id INNER JOIN `tb_admin.usuario` AS au ON fup.usuario = au.id WHERE fup.pdv = ? OR fup.usuario = ?");
						$sql->execute(array($pdv, $user));
						return $sql->fetchAll();
						
					}else{

						$sql= MySql::conectarDb()->prepare("SELECT fup.id AS id, fup.usuario AS usuario, fup.pdv AS pdv, fp.nome AS 'nome-pdv', au.nome AS 'nome-usuario', au.usuario AS 'user' FROM `tb_fin.usuario-pdv` AS fup INNER JOIN `tb_fin.pdv` AS fp ON fup.pdv = fp.id INNER JOIN `tb_admin.usuario` AS au ON fup.usuario = au.id WHERE fup.pdv = ? AND fup.usuario = ?");
						$sql->execute(array($pdv, $user));

						return $sql->fetchAll();
						
					}

				}
			}else{
				if (isset($_POST['pesquisar'])) {
					
					$user = $_POST['usuario'];
					$pdv = $_POST['pdv'];

					if ($user == '' ||  $pdv == '') {

						if ($user == '' &&  $pdv == '') {

							Painel::alerta('erro','gentileza colocar pelo menos um parametro para realizar a buscar');
						}

						$sql= MySql::conectarDb()->prepare("SELECT fup.id AS id, fup.usuario AS usuario, fup.pdv AS pdv, fp.nome AS 'nome-pdv', au.nome AS 'nome-usuario', au.usuario AS 'user' FROM `tb_fin.usuario-pdv` AS fup INNER JOIN `tb_fin.pdv` AS fp ON fup.pdv = fp.id INNER JOIN `tb_admin.usuario` AS au ON fup.usuario = au.id WHERE fup.pdv = ? OR fup.usuario = ? LIMIT $start,$end");
						$sql->execute(array($pdv, $user));

						return $sql->fetchAll();

						

					}else{

						$sql= MySql::conectarDb()->prepare("SELECT fup.id AS id, fup.usuario AS usuario, fup.pdv AS pdv, fp.nome AS 'nome-pdv', au.nome AS 'nome-usuario', au.nome AS 'nome-usuario', au.usuario AS 'user' FROM `tb_fin.usuario-pdv` AS fup INNER JOIN `tb_fin.pdv` AS fp ON fup.pdv = fp.id INNER JOIN `tb_admin.usuario` AS au ON fup.usuario = au.id WHERE fup.pdv = ? AND fup.usuario = ? LIMIT $start,$end");
						$sql->execute(array($pdv, $user));

						return $sql->fetchAll();
						
						
					}

				}
			}
		}

		public static function selectAllPdvUsuario($start = null, $end = null){

			if ($start == null && $end == null){
				$sql = MySql::conectarDb()->prepare("SELECT fup.id AS id, fup.usuario AS usuario, fup.pdv AS pdv, fp.nome AS 'nome-pdv', au.nome AS 'nome-usuario', au.usuario AS 'user' FROM `tb_fin.usuario-pdv` AS fup INNER JOIN `tb_fin.pdv` AS fp ON fup.pdv = fp.id INNER JOIN `tb_admin.usuario` AS au ON fup.usuario = au.id  WHERE fup.ativo = 1 ");
			}
			else{
				$sql = MySql::conectarDb()->prepare("SELECT fup.id AS id, fup.usuario AS usuario, fup.pdv AS pdv, fp.nome AS 'nome-pdv', au.nome AS 'nome-usuario', au.usuario AS 'user' FROM `tb_fin.usuario-pdv` AS fup INNER JOIN `tb_fin.pdv` AS fp ON fup.pdv = fp.id INNER JOIN `tb_admin.usuario` AS au ON fup.usuario = au.id  WHERE fup.ativo = 1 LIMIT $start,$end");	
			}
			
			$sql->execute();

			return $sql->fetchAll();

		}

		public static function updateItem($arr){

			$certo = true;
			$first = false;
			$tabela = $arr['nome_tabela'];

			@$query = "UPDATE `$tabela` SET ";

			foreach ($arr as $key => $value) {
				$nome = $key;
				$valor = $value;

				if ($nome == 'atualizar' || $nome == 'nome_tabela') {
					
					continue;
				}
				if ($valor == '') {
					
					$certo = false;
					break;
				}
				if ($first == false) {
					$first = true;
					$query.= "$nome = ?";
				}else{
					$query.= ",$nome = ?";
				}

				$parametros[] = $value;
			}


			if ($certo == true) {
				$parametros[] = $arr['id'];
				$sql = MySql::conectarDb()->prepare($query.' WHERE id=?');
				$sql->execute($parametros);
			}

			return $certo;
		}

		
}

?>