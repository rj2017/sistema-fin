<?php
	
	class Financeiro
	{
		

		public static function entrada(){

			if (isset($_POST['enviar'])){
				
				$descricao = $_POST['descricao'];
				$tipo = strstr($_POST['tipo'], ' ', true);
				$data = $_POST['data'];
				$val = (float) $_POST['valor'];
				$pdv = $_SESSION['pdv'];
				$usuario = $_SESSION['id'];
				$qtn = $_POST['quantidade'];

				if ($qtn <= 0) {
					
					Painel::alerta('erro','O número de "quantidade" tem que ser maior que 0');
					die();
					Painel::redirect('lancamentos_entradas');

				}


				$i = 0;

				while ( $i < $qtn) {
					

				$pdo = MySql::conectarDB()->prepare("INSERT INTO `tb_fin.entradas`(`id`, `descricao`, `parametro` , `data`,`valor`, `pdv`,`usuario`) VALUES (null,?,?,?,?,?,?)");
				$pdo->execute(array($descricao,$tipo,$data,$val,$pdv,$usuario));

				$i++;

				}

				if ($pdo->rowCount() == 1) {
					Painel::alerta('sucesso','Entrada realizada com sucesso!');
				Painel::redirect('fin_entrada');
				}else{
				Painel::alerta('erro','Houve um erro, gentileza contactar o administrador!');
				}
				
			}

		}

		public static function saida(){

			if (isset($_POST['enviar'])){
				
				$descricao = $_POST['descricao'];
				$tipo = strstr($_POST['tipo'], ' ', true);
				$data = $_POST['data'];
				$val = (float) $_POST['valor'];
				$pdv = $_SESSION['pdv'];
				$usuario = $_SESSION['id'];
				$qtn = $_POST['quantidade'];

				if ($qtn <= 0) {
					
					Painel::alerta('erro','O número de "quantidade" tem que ser maior que 0');
				}


				$i = 0;

				while ( $i < $qtn) {
					

				$pdo = MySql::conectarDB()->prepare("INSERT INTO `tb_fin.saidas`(`id`, `descricao`, `parametro` , `data`,`valor`, `pdv`,`usuario`) VALUES (null,?,?,?,?,?,?)");
				$pdo->execute(array($descricao,$tipo,$data,$val,$pdv,$usuario));

				$i++;

				}

				
				

				if ($pdo->rowCount() == 1) {
					Painel::alerta('sucesso','Saída realizada com sucesso!');
					Painel::redirect('fin_saida');
				}else{
				Painel::alerta('erro','Houve um erro, gentileza contactar o administrador!');
				}
				
			}

		}

		public static function CadastrarParametros(){

			if (isset($_POST['enviar'])) {

				$descricao = $_POST['descricao'];
				$ativo = $_POST['ativo'];
				$pdv = $_SESSION['pdv'];

				if (self::verificarParametroExiste($descricao)) {

						Painel::alerta('erro','Esse parametro já foi cadastrado!');

					}else{

					$pdo = MySql::conectarDb()->prepare("INSERT INTO `tb_fin.parametro` (`id`,`descricao`, `ativo`,`pdv`) VALUES(null,?,?,?)");
					$pdo->execute(array($descricao,$ativo, $pdv));

					if ($pdo->rowCount() == 1) {
					Painel::alerta('sucesso','cadastrado com sucesso!');
						Painel::redirect('cad_tipo');
					}else{
					Painel::alerta('erro','Houve um erro, gentileza contactar o administrador!');
					}

				}
			}
		}

		public static function CadastrarSubParametros(){

			if (isset($_POST['enviar'])) {

				$descricao = $_POST['descricao'];
				$tipo = $_POST['tipo'];
				$ativo = $_POST['ativo'];
				$pdv = $_SESSION['pdv'];


				if (self::verificarSubParametroExiste($descricao)) {

						Painel::alerta('erro','Esse parametro já foi cadastrado!');

					}else{

					$pdo = MySql::conectarDb()->prepare("INSERT INTO `tb_fin.sub-parametro` (`id`,`descricao`,`parametro`, `ativo`,`pdv`) VALUES(null,?,?,?,?)");
					$pdo->execute(array($descricao,$tipo,$ativo,$pdv));

					if ($pdo->rowCount() == 1) {
					Painel::alerta('sucesso','cadastrado com sucesso!');
						Painel::redirect('cad_subTipo');
					}else{
					Painel::alerta('erro','Houve um erro, gentileza contactar o administrador!');
					}

				}
			}
		}

			public static function selectParametro($start = null, $end = null){

			$pdv = $_SESSION['pdv'];


			if ($start == null && $end == null)
				$sql = MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.parametro` WHERE pdv = ? ");
			else
				$sql = MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.parametro` WHERE  pdv = ? LIMIT $start,$end");

			
			
			$sql->execute(array($pdv));
			return $sql->fetchAll();

		}

		public static function selectSubParametro($parametro ,$start = null, $end = null){

			$pdv = $_SESSION['pdv'];

			if ($parametro == '') {

				if ($start == null && $end == null)
					$sql = MySql::conectarDb()->prepare("SELECT a.id AS 'id', a.descricao AS 'descricao', b.descricao AS 'parametro', a.ativo AS 'ativo' FROM `tb_fin.sub-parametro` AS a INNER JOIN `tb_fin.parametro` AS b ON a.parametro = b.id WHERE  a.pdv = ? ");
				else
					$sql = MySql::conectarDb()->prepare("SELECT a.id AS 'id', a.descricao AS 'descricao', b.descricao AS 'parametro', a.ativo AS 'ativo' FROM `tb_fin.sub-parametro` AS a INNER JOIN `tb_fin.parametro` AS b ON a.parametro = b.id WHERE  a.pdv = ? LIMIT $start,$end");
				$sql->execute(array( $pdv));
				
			}else{


				if ($start == null && $end == null)
					$sql = MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.sub-parametro` WHERE `parametro` = ? AND pdv = ? ");
				else
					$sql = MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.sub-parametro` WHERE `parametro` = ? AND pdv = ? LIMIT $start,$end");
				$sql->execute(array($parametro, $pdv));
			}

			
			
			
			return $sql->fetchAll();

		}

		public static function verificarParametroExiste($descricao){

			$sql = MySql::conectarDb()->prepare('SELECT `descricao` FROM `tb_fin.parametro` WHERE `descricao` = ? ');
			$sql->execute(array($descricao));

			if ($sql->rowCount() == 1) {
				return true;
			}else{
				return false;
			}
		}

		public static function verificarSubParametroExiste($descricao){

			$sql = MySql::conectarDb()->prepare('SELECT `descricao` FROM `tb_fin.sub-parametro` WHERE `descricao` = ? ');
			$sql->execute(array($descricao));

			if ($sql->rowCount() == 1) {
				return true;
			}else{
				return false;
			}
		}

		public static function somaEntradas($dataIni,$dataFin){

			if ($dataFin < $dataIni) {
				Painel::alerta('erro','A data final não pode ser menor que a data inicial!');
			}else{

				$pdv = $_SESSION['pdv'];
				$sql = MySql::conectarDb()->prepare("SELECT ROUND(SUM(valor), 2) as valor FROM `tb_fin.entradas` WHERE pdv = ? AND (data >= ? AND data <= ? )");
				$sql->execute(array($pdv, $dataIni, $dataFin));
				$sql = $sql->fetch();
				return $sql[0];
			}

			
		}

		public static function somaSaidas($dataIni,$dataFin){

			if ($dataFin < $dataIni) {
				Painel::alerta('erro','A data final não pode ser menor que a data inicial!');
			}else{

				$pdv = $_SESSION['pdv'];
				$sql = MySql::conectarDb()->prepare("SELECT ROUND(SUM(valor), 2) as valor FROM `tb_fin.saidas` WHERE pdv = ? AND (data >= ? AND data <= ? )");
				$sql->execute(array($pdv, $dataIni, $dataFin));
				$sql = $sql->fetch();
				return $sql[0];
			}

			
		}

		public static function buscarPdv($pdv){
			$sql = MySql::conectarDb()->prepare("SELECT nome FROM `tb_fin.pdv` WHERE ativo = 1 AND id = ? ");
			$sql->execute(array($pdv));
			$info = $sql->fetch();

			return $info[0];

		}

		public static function pesquisarEntradas($start = null, $end = null){

			if ($start == null && $end == null){
					
					$nome = $_POST['nome'];
					$dataIni = $_POST['data-inicial'];
					$dataFin = $_POST['data-final'];
					$pdv = $_SESSION['pdv'];

					if ($dataFin < $dataIni) {
						Painel::alerta('erro','A data final não pode ser menor que a data inicial!');

					}elseif ($nome == '') {


							$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.entradas` WHERE `pdv` = ? AND `data` >= ? AND `data` <= ?");
							$sql->execute(array($pdv,$dataIni, $dataFin));

							return $sql->fetchAll();	

					}elseif ($nome != '') {

							$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.entradas` WHERE `pdv` = ? AND `descricao` = ? AND `data` >= ? AND `data` <= ?");
							$sql->execute(array($pdv, $nome, $dataIni, $dataFin));

							return $sql->fetchAll();
						
					}

						
					

			}else{
					
					$nome = $_POST['nome'];
					$dataIni = $_POST['data-inicial'];
					$dataFin = $_POST['data-final'];

					if ($dataFin < $dataIni) {
						Painel::alerta('erro','A data final não pode ser menor que a data inicial!');
					}elseif ($nome == '') {


							$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.entradas` WHERE `pdv` = ? AND `data` >= ? AND `data` <= ? LIMIT $start,$end");
							$sql->execute(array($dataIni,$dataFin));

							return $sql->fetchAll();	

						}elseif ($nome != '') {

							$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.entradas` WHERE `pdv` = ? AND `descricao` = ? AND `data` >= ? AND `data` <= ? LIMIT $start,$end");
							$sql->execute(array($pdv,$nome, $dataIni,$dataFin));

							return $sql->fetchAll();
						
								}

					}
			}

			public static function pesquisarSaidas($start = null, $end = null){

			if ($start == null && $end == null){
					
					$nome = $_POST['nome'];
					$dataIni = $_POST['data-inicial'];
					$dataFin = $_POST['data-final'];
					$pdv = $_SESSION['pdv'];

					if ($dataFin < $dataIni) {
						Painel::alerta('erro','A data final não pode ser menor que a data inicial!');
					}elseif ($nome == '') {


							$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.saidas` WHERE `pdv` = ? AND `data` >= ? AND `data` <= ?");
							$sql->execute(array($pdv, $dataIni, $dataFin));

							return $sql->fetchAll();	

					}elseif ($nome != '') {

							$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.saidas` WHERE `pdv`=? AND `descricao` = ? AND `data` >= ? AND `data` <= ?");
							$sql->execute(array($pdv, $nome, $dataIni, $dataFin));

							return $sql->fetchAll();
						
					}

						
					

			}else{
					
					$nome = $_POST['nome'];
					$dataIni = $_POST['data-inicial'];
					$dataFin = $_POST['data-final'];

					if ($dataFin < $dataIni) {
						Painel::alerta('erro','A data final não pode ser menor que a data inicial!');
					}elseif ($nome == '') {


							$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.saidas` WHERE `pdv`=? AND `data` >= ? AND `data` <= ? LIMIT $start,$end");
							$sql->execute(array($pdv,$dataIni,$dataFin));

							return $sql->fetchAll();	

						}elseif ($nome != '') {

							$sql= MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.saidas` WHERE `pdv`= ? AND `descricao` = ? AND `data` >= ? AND `data` <= ? LIMIT $start,$end");
							$sql->execute(array($pdv, $nome, $dataIni,$dataFin));

							return $sql->fetchAll();
						
								}

					}
			}

			public static function pdvUsuario(){

			if (isset($_POST['cadastrar'])) {
				
				$pdv = strstr($_POST['pdv'], ' ', true);
				$usuario = strstr($_POST['usuario'], ' ', true);

				$pdo = MySql::conectarDb()->prepare("INSERT INTO `tb_fin.usuario-pdv` VALUES (null,?,?,1)");
				

				if ($pdo->execute(array($usuario,$pdv))) {
					
					Painel::alerta('sucesso','Cadastrado com sucesso!');
				}else{
					Painel::alerta('erro', 'Houve um erro na hora do cadastro!');
				}

				Painel::redirect('pdv_usuario');
			}
		}


			public static function selectLancamentos($tabela,$start = null, $end = null){

				$pdv = $_SESSION['pdv'];

			if ($start == null && $end == null)
				$sql = MySql::conectarDb()->prepare("SELECT * FROM `$tabela` WHERE `pdv` = ? ");
			else
				$sql = MySql::conectarDb()->prepare("SELECT * FROM `$tabela` WHERE `pdv` = ? LIMIT $start,$end");

			
			
			$sql->execute(array($pdv));
			return $sql->fetchAll();

		}



		}

?>