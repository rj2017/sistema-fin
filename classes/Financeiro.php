<?php
	
	class Financeiro
	{
		

		public static function entrada(){

			if (isset($_POST['enviar'])){
				
				$item = $_POST['cod'];
				$tipo = $_POST['tipo'];
				$subTipo = $_POST['sub-tipo'];
				$data = $_POST['data'];
				$qtn = $_POST['quantidade'];
				$desc = (float) $_POST['desconto'];
				$val = (float) $_POST['valor'];
				$total = (float) $_POST['total'];
				$pdv = $_SESSION['pdv'];
				$usuario = $_SESSION['id'];
				

				if ($qtn <= 0) {
					
					Painel::alerta('erro','O número de "quantidade" tem que ser maior que 0');
					die();
					Painel::redirect('fin_entrada');

				}

					

				$pdo = MySql::conectarDB()->prepare("INSERT INTO `tb_fin.entradas`(`id`, `item`, `parametro`, `sub_parametro`, `data`, `quantidade`, `desconto`, `valor`, `total`,  `pdv`,`usuario`) VALUES (null,?,?,?,?,?,?,?,?,?,?)");
				$pdo->execute(array($item, $tipo, $subTipo,$data, $qtn, $desc, $val, $total, $pdv, $usuario));


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
				
				$item = $_POST['cod'];
				$tipo = $_POST['tipo'];
				$subTipo = $_POST['sub-tipo'];
				$data = $_POST['data'];
				$qtn = $_POST['quantidade'];
				$desc = (float) $_POST['desconto'];
				$val = (float) $_POST['valor'];
				$total = (float) $_POST['total'];
				$pdv = $_SESSION['pdv'];
				$usuario = $_SESSION['id'];
				

				if ($qtn <= 0) {
					
					Painel::alerta('erro','O número de "quantidade" tem que ser maior que 0');
					die();
					Painel::redirect('fin_entrada');

				}

					

				$pdo = MySql::conectarDB()->prepare("INSERT INTO `tb_fin.saidas`(`id`, `item`, `parametro`, `sub_parametro`, `data`, `quantidade`, `desconto`, `valor`, `total`,  `pdv`,`usuario`) VALUES (null,?,?,?,?,?,?,?,?,?,?)");
				$pdo->execute(array($item, $tipo, $subTipo,$data, $qtn, $desc, $val, $total, $pdv, $usuario));


				if ($pdo->rowCount() == 1) {
					Painel::alerta('sucesso','Entrada realizada com sucesso!');
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

		public static function CadastrarItem(){

			if (isset($_POST['enviar'])) {

				$descricao = $_POST['descricao'];
				$tipo = $_POST['tipo'];
				$sub = $_POST['sub-tipo'];
				$ativo = $_POST['ativo'];
				$valor = $_POST['valor'];
				$pdv = $_SESSION['pdv'];

				if (self::verificarParametroExiste($descricao)) {

						Painel::alerta('erro','Esse Item já foi cadastrado!');

					}else{

					$pdo = MySql::conectarDb()->prepare("INSERT INTO `tb_fin.itens` (`id`,`descricao`, `subParametro`, `valor`, `pdv`,`ativo`) VALUES(null,?,?,?,?,?)");
					$pdo->execute(array($descricao,$sub, $valor, $pdv, $ativo));

					if ($pdo->rowCount() == 1) {
						Painel::alerta('sucesso','cadastrado com sucesso!');
						Painel::redirect('cad_item');
					}else{
						Painel::alerta('erro','Houve um erro, gentileza contactar o administrador!');
					}

				}
			}
		}

			public static function selectParametro($start = null, $end = null){

			$pdv = $_SESSION['pdv'];

			if (isset($_POST['pesquisar'])) {

				$descricao = $_POST['nome'];
				$ativo = $_POST['ativo'];

				if ($descricao == '') {
					if ($start == null && $end == null)
					$sql = MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.parametro` WHERE pdv = ? AND ativo = ? ");
					else
					$sql = MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.parametro` WHERE  pdv = ? AND ativo = ? LIMIT $start,$end");

					$sql->execute(array($pdv, $ativo));

				}else{

					if ($start == null && $end == null)
					$sql = MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.parametro` WHERE pdv = ? AND ativo = ? AND descricao = ? ");
					else
					$sql = MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.parametro` WHERE  pdv = ? AND ativo = ? AND descricao = ? LIMIT $start,$end");

					$sql->execute(array($pdv, $ativo, $descricao));
				}
				
			}else{


			if ($start == null && $end == null)
				$sql = MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.parametro` WHERE pdv = ? ");
			else
				$sql = MySql::conectarDb()->prepare("SELECT * FROM `tb_fin.parametro` WHERE  pdv = ? LIMIT $start,$end");

			
			
			$sql->execute(array($pdv));

			}
			return $sql->fetchAll();

		}

		public static function selectSubParametro($parametro ,$start = null, $end = null){

			$pdv = $_SESSION['pdv'];

			if (isset($_POST['pesquisar'])) {

				$descricao = $_POST['nome'];
				$tipo = $_POST['tipo'];
				$ativo = $_POST['ativo'];

				if ($descricao == '') {
					if ($tipo =='') {
						if ($start == null && $end == null)
							$sql = MySql::conectarDb()->prepare("SELECT a.id AS 'id', a.descricao AS 'descricao', b.descricao AS 'parametro', a.ativo AS 'ativo' FROM `tb_fin.sub-parametro` AS a INNER JOIN `tb_fin.parametro` AS b ON a.parametro = b.id WHERE  a.pdv = ? AND a.ativo = ? ");
						else
							$sql = MySql::conectarDb()->prepare("SELECT a.id AS 'id', a.descricao AS 'descricao', b.descricao AS 'parametro', a.ativo AS 'ativo' FROM `tb_fin.sub-parametro` AS a INNER JOIN `tb_fin.parametro` AS b ON a.parametro = b.id WHERE  a.pdv = ? AND a.ativo = ? LIMIT $start,$end");
						$sql->execute(array( $pdv, $ativo));
						
					}else{
						if ($start == null && $end == null)
							$sql = MySql::conectarDb()->prepare("SELECT a.id AS 'id', a.descricao AS 'descricao', b.descricao AS 'parametro', a.ativo AS 'ativo' FROM `tb_fin.sub-parametro` AS a INNER JOIN `tb_fin.parametro` AS b ON a.parametro = b.id WHERE  a.pdv = ? AND a.ativo = ? AND a.parametro = ? ");
						else
							$sql = MySql::conectarDb()->prepare("SELECT a.id AS 'id', a.descricao AS 'descricao', b.descricao AS 'parametro', a.ativo AS 'ativo' FROM `tb_fin.sub-parametro` AS a INNER JOIN `tb_fin.parametro` AS b ON a.parametro = b.id WHERE  a.pdv = ? AND a.ativo = ? AND a.parametro = ? LIMIT $start,$end");
						$sql->execute(array( $pdv, $ativo,$tipo));
					}
				}else{
					if ($tipo =='') {
						if ($start == null && $end == null)
							$sql = MySql::conectarDb()->prepare("SELECT a.id AS 'id', a.descricao AS 'descricao', b.descricao AS 'parametro', a.ativo AS 'ativo' FROM `tb_fin.sub-parametro` AS a INNER JOIN `tb_fin.parametro` AS b ON a.parametro = b.id WHERE  a.pdv = ? AND a.ativo = ? AND a.descricao = ? ");
						else
							$sql = MySql::conectarDb()->prepare("SELECT a.id AS 'id', a.descricao AS 'descricao', b.descricao AS 'parametro', a.ativo AS 'ativo' FROM `tb_fin.sub-parametro` AS a INNER JOIN `tb_fin.parametro` AS b ON a.parametro = b.id WHERE  a.pdv = ? AND a.ativo = ? AND a.descricao = ? LIMIT $start,$end");
						$sql->execute(array( $pdv, $ativo,$descricao));
						
					}else{
						if ($start == null && $end == null)
							$sql = MySql::conectarDb()->prepare("SELECT a.id AS 'id', a.descricao AS 'descricao', b.descricao AS 'parametro', a.ativo AS 'ativo' FROM `tb_fin.sub-parametro` AS a INNER JOIN `tb_fin.parametro` AS b ON a.parametro = b.id WHERE  a.pdv = ? AND a.ativo = ? AND a.parametro = ? AND a.descricao = ? ");
						else
							$sql = MySql::conectarDb()->prepare("SELECT a.id AS 'id', a.descricao AS 'descricao', b.descricao AS 'parametro', a.ativo AS 'ativo' FROM `tb_fin.sub-parametro` AS a INNER JOIN `tb_fin.parametro` AS b ON a.parametro = b.id WHERE  a.pdv = ? AND a.ativo = ? AND a.parametro = ? AND a.descricao = ? LIMIT $start,$end");
						$sql->execute(array( $pdv, $ativo,$tipo, $descricao));

					}
				}
			

			}else{


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

			}
			
			
			return $sql->fetchAll();

		}

		public static function selectItem($cod = null,$start = null, $end = null){

			$pdv = $_SESSION['pdv'];

			if ( $cod != null ) {

				if ($start == null && $end == null){
				$sql = MySql::conectarDb()->prepare("SELECT a.ativo AS 'ativo', a.id AS 'id', a.descricao AS 'descricao', a.valor AS 'valor', a.pdv AS 'pdv', b.id AS 'id_sub-parametro', b.descricao AS 'sub-parametro', c.id AS 'id_parametro', c.descricao AS 'parametro' FROM `tb_fin.itens` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.subParametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id WHERE a.pdv = ? AND a.id = ? ");
			}else{
				$sql = MySql::conectarDb()->prepare("SELECT a.ativo AS 'ativo', a.id AS 'id', a.descricao AS 'descricao', a.valor AS 'valor', a.pdv AS 'pdv', b.id AS 'id_sub-parametro', b.descricao AS 'sub-parametro', c.id AS 'id_parametro', c.descricao AS 'parametro' FROM `tb_fin.itens` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.subParametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id WHERE a.pdv = ? AND a.id = ? LIMIT $start,$end");
			}

			
			
			$sql->execute(array($pdv, $cod));

			}else{


			if ($start == null && $end == null)
				$sql = MySql::conectarDb()->prepare("SELECT a.ativo AS 'ativo', a.id AS 'id', a.descricao AS 'descricao', a.valor AS 'valor', a.pdv AS 'pdv', b.id AS 'id_sub-parametro', b.descricao AS 'sub-parametro', c.id AS 'id_parametro', c.descricao AS 'parametro' FROM `tb_fin.itens` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.subParametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id WHERE a.pdv = ? ");
			else
				$sql = MySql::conectarDb()->prepare("SELECT a.ativo AS 'ativo', a.id AS 'id', a.descricao AS 'descricao', a.valor AS 'valor', a.pdv AS 'pdv', b.id AS 'id_sub-parametro', b.descricao AS 'sub-parametro', c.id AS 'id_parametro', c.descricao AS 'parametro' FROM `tb_fin.itens` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.subParametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id WHERE a.pdv = ? LIMIT $start,$end");

			
			
			$sql->execute(array($pdv));
			

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
				$sql = MySql::conectarDb()->prepare("SELECT ROUND(SUM(total), 2) as valor FROM `tb_fin.entradas` WHERE pdv = ? AND (data >= ? AND data <= ? )");
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
				$sql = MySql::conectarDb()->prepare("SELECT ROUND(SUM(total), 2) as valor FROM `tb_fin.saidas` WHERE pdv = ? AND (data >= ? AND data <= ? )");
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


							$sql= MySql::conectarDb()->prepare("SELECT a.id AS id,d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, a.usuario AS usuario  FROM `tb_fin.entradas` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id WHERE a.pdv = ? AND a.data >= ? AND a.data <= ?");
							$sql->execute(array($pdv,$dataIni, $dataFin));

							return $sql->fetchAll();	

					}elseif ($nome != '') {

							$sql= MySql::conectarDb()->prepare("SELECT a.id AS id,d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, a.usuario AS usuario  FROM `tb_fin.entradas` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id WHERE a.pdv = ? AND d.descricao = ? AND a.data >= ? AND a.data <= ?");
							$sql->execute(array($pdv, $nome, $dataIni, $dataFin));

							return $sql->fetchAll();
						
					}

						
					

			}else{
					
					$nome = $_POST['nome'];
					$dataIni = $_POST['data-inicial'];
					$dataFin = $_POST['data-final'];
					$pdv = $_SESSION['pdv'];

					if ($dataFin < $dataIni) {
						Painel::alerta('erro','A data final não pode ser menor que a data inicial!');
					}elseif ($nome == '') {


							$sql= MySql::conectarDb()->prepare("SELECT a.id AS id,d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, a.usuario AS usuario  FROM `tb_fin.entradas` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id WHERE a.pdv = ? AND a.data >= ? AND a.data <= ? LIMIT $start,$end");
							$sql->execute(array($dataIni,$dataFin));

							return $sql->fetchAll();	

						}elseif ($nome != '') {

							$sql= MySql::conectarDb()->prepare("SELECT a.id AS id,d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, a.usuario AS usuario  FROM `tb_fin.entradas` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id WHERE a.pdv = ? AND d.descricao = ? AND a.data >= ? AND a.data <= ? LIMIT $start,$end");
							$sql->execute(array($pdv,$nome, $dataIni,$dataFin));

							return $sql->fetchAll();
						
								}

					}
			}

			public static function pesquisarSaidas($start = null, $end = null){
				$pdv = $_SESSION['pdv'];

			if ($start == null && $end == null){
					
					$nome = $_POST['nome'];
					$dataIni = $_POST['data-inicial'];
					$dataFin = $_POST['data-final'];
					

					if ($dataFin < $dataIni) {
						Painel::alerta('erro','A data final não pode ser menor que a data inicial!');
					}elseif ($nome == '') {


							$sql= MySql::conectarDb()->prepare("SELECT a.id AS id,d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, a.usuario AS usuario  FROM `tb_fin.saidas` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id WHERE a.pdv = ? AND a.data >= ? AND a.data <= ?");
							$sql->execute(array($pdv, $dataIni, $dataFin));

							return $sql->fetchAll();	

					}elseif ($nome != '') {

							$sql= MySql::conectarDb()->prepare("SELECT a.id AS id,d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, a.usuario AS usuario  FROM `tb_fin.saidas` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id WHERE a.pdv=? AND d.descricao = ? AND a.data >= ? AND a.data <= ?");
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


							$sql= MySql::conectarDb()->prepare("SELECT a.id AS id,d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, a.usuario AS usuario  FROM `tb_fin.saidas` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id WHERE a.pdv=? AND a.data >= ? AND a.data <= ? LIMIT $start,$end");
							$sql->execute(array($pdv,$dataIni,$dataFin));

							return $sql->fetchAll();	

						}elseif ($nome != '') {

							$sql= MySql::conectarDb()->prepare("SELECT a.id AS id,d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, a.usuario AS usuario  FROM `tb_fin.saidas` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id WHERE a.pdv= ? AND d.descricao = ? AND a.data >= ? AND a.data <= ? LIMIT $start,$end");
							$sql->execute(array($pdv, $nome, $dataIni,$dataFin));

							return $sql->fetchAll();
						
								}

					}
			}

			public static function pesquisarItens($cod = null,$start = null, $end = null){

				$pdv = $_SESSION['pdv'];
				$codigo = $_POST['cod'];
				$descricao = $_POST['nome'];
				$ativo = $_POST['ativo'];

				if ($codigo == '') {

					if ($descricao =='') {

						if ($start == null && $end == null)
							$sql = MySql::conectarDb()->prepare("SELECT a.ativo AS 'ativo', a.id AS 'id', a.descricao AS 'descricao', a.valor AS 'valor', a.pdv AS 'pdv', b.id AS 'id_sub-parametro', b.descricao AS 'sub-parametro', c.id AS 'id_parametro', c.descricao AS 'parametro' FROM `tb_fin.itens` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.subParametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id WHERE a.pdv = ?  AND a.ativo = ? ");
						else
							$sql = MySql::conectarDb()->prepare("SELECT a.ativo AS 'ativo', a.id AS 'id', a.descricao AS 'descricao', a.valor AS 'valor', a.pdv AS 'pdv', b.id AS 'id_sub-parametro', b.descricao AS 'sub-parametro', c.id AS 'id_parametro', c.descricao AS 'parametro' FROM `tb_fin.itens` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.subParametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id WHERE a.pdv = ? AND a.ativo = ? LIMIT $start,$end ");
				

					$sql->execute(array($pdv,$ativo));
						
					}else{

						if ($start == null && $end == null)
								$sql = MySql::conectarDb()->prepare("SELECT a.ativo AS 'ativo', a.id AS 'id', a.descricao AS 'descricao', a.valor AS 'valor', a.pdv AS 'pdv', b.id AS 'id_sub-parametro', b.descricao AS 'sub-parametro', c.id AS 'id_parametro', c.descricao AS 'parametro' FROM `tb_fin.itens` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.subParametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id WHERE a.pdv = ? AND a.descricao = ? AND a.ativo = ? ");
							else
								$sql = MySql::conectarDb()->prepare("SELECT a.ativo AS 'ativo', a.id AS 'id', a.descricao AS 'descricao', a.valor AS 'valor', a.pdv AS 'pdv', b.id AS 'id_sub-parametro', b.descricao AS 'sub-parametro', c.id AS 'id_parametro', c.descricao AS 'parametro' FROM `tb_fin.itens` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.subParametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id WHERE a.pdv = ? AND a.descricao = ? AND a.ativo = ? LIMIT $start,$end ");

				

							$sql->execute(array($pdv, $descricao, $ativo));

					}


				}else{
					if ($descricao == '') {
						if ($start == null && $end == null)
							$sql = MySql::conectarDb()->prepare("SELECT a.ativo AS 'ativo', a.id AS 'id', a.descricao AS 'descricao', a.valor AS 'valor', a.pdv AS 'pdv', b.id AS 'id_sub-parametro', b.descricao AS 'sub-parametro', c.id AS 'id_parametro', c.descricao AS 'parametro' FROM `tb_fin.itens` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.subParametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id WHERE a.pdv = ? AND a.id = ? AND a.ativo = ? ");
						else
							$sql = MySql::conectarDb()->prepare("SELECT a.ativo AS 'ativo', a.id AS 'id', a.descricao AS 'descricao', a.valor AS 'valor', a.pdv AS 'pdv', b.id AS 'id_sub-parametro', b.descricao AS 'sub-parametro', c.id AS 'id_parametro', c.descricao AS 'parametro' FROM `tb_fin.itens` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.subParametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id WHERE a.pdv = ? AND a.id = ? AND a.ativo = ? LIMIT $start,$end ");

				

							$sql->execute(array($pdv, $codigo, $ativo));
					}else{

						if ($start == null && $end == null)
							$sql = MySql::conectarDb()->prepare("SELECT a.ativo AS 'ativo', a.id AS 'id', a.descricao AS 'descricao', a.valor AS 'valor', a.pdv AS 'pdv', b.id AS 'id_sub-parametro', b.descricao AS 'sub-parametro', c.id AS 'id_parametro', c.descricao AS 'parametro' FROM `tb_fin.itens` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.subParametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id WHERE a.pdv = ? AND a.id = ? AND a.descricao = ? AND a.ativo = ? ");
						else
							$sql = MySql::conectarDb()->prepare("SELECT a.ativo AS 'ativo', a.id AS 'id', a.descricao AS 'descricao', a.valor AS 'valor', a.pdv AS 'pdv', b.id AS 'id_sub-parametro', b.descricao AS 'sub-parametro', c.id AS 'id_parametro', c.descricao AS 'parametro' FROM `tb_fin.itens` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.subParametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id WHERE a.pdv = ? AND a.id = ? AND a.descricao = ? AND a.ativo = ? LIMIT $start,$end ");

				

							$sql->execute(array($pdv, $codigo, $descricao, $ativo));

					}


				}

					return $sql->fetchAll();

			

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
				$sql = MySql::conectarDb()->prepare("SELECT a.id AS id, d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, a.usuario AS usuario  FROM `$tabela` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id  WHERE a.pdv = ? ");
			else
				$sql = MySql::conectarDb()->prepare("SELECT a.id AS id, d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, a.usuario AS usuario  FROM `$tabela` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id  WHERE a.pdv = ? LIMIT $start,$end");

			
			
			$sql->execute(array($pdv));
			return $sql->fetchAll();

		}



		}

?>