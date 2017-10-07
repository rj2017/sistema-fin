<?php
	
	class Financeiro
	{
		

		public static function entrada(){

			if (isset($_POST['enviar'])){
				
				$descricao = $_POST['descricao'];
				$data = $_POST['data'];
				$val = (float) $_POST['valor'];
				$pdv = $_SESSION['pdv'];
				$usuario = $_SESSION['id'];

				$pdo = MySql::conectarDB()->prepare("INSERT INTO `tb_fin.entradas`(`id`, `descricao`, `data`,`valor`, `pdv`,`usuario`) VALUES (null,?,?,?,?,?)");
				$pdo->execute(array($descricao,$data,$val,$pdv,$usuario));
				

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
				$data = $_POST['data'];
				$val = (float) $_POST['valor'];
				$pdv = $_SESSION['pdv'];
				$usuario = $_SESSION['id'];

				$pdo = MySql::conectarDB()->prepare("INSERT INTO `tb_fin.saidas`(`id`, `descricao`, `data`,`valor`, `pdv`,`usuario`) VALUES (null,?,?,?,?,?)");
				$pdo->execute(array($descricao,$data,$val,$pdv,$usuario));
				

				if ($pdo->rowCount() == 1) {
					Painel::alerta('sucesso','Saída realizada com sucesso!');
				Painel::redirect('fin_entrada');
				}else{
				Painel::alerta('erro','Houve um erro, gentileza contactar o administrador!');
				}
				
			}

		}

		public static function somaEntradas(){

			$pdv = $_SESSION['pdv'];
			$sql = MySql::conectarDb()->prepare("SELECT ROUND(SUM(valor), 2) as valor FROM `tb_fin.entradas` WHERE pdv = ?");
			$sql->execute(array($pdv));
			$sql = $sql->fetch();

			return $sql[0];
		}

		public static function somaSaidas(){

			$pdv = $_SESSION['pdv'];
			$sql = MySql::conectarDb()->prepare("SELECT ROUND(SUM(valor), 2) as valor FROM `tb_fin.saidas` WHERE pdv = ?");
			$sql->execute(array($pdv));
			$sql = $sql->fetch();

			return $sql[0];
		}

		public static function buscarPdv($pdv){
			$sql = MySql::conectarDb()->prepare("SELECT nome FROM `tb_fin.pdv` WHERE ativo = 1 AND id = ? ");
			$sql->execute(array($pdv));
			$info = $sql->fetch();

			return $info[0];

		}
	}
?>