<?php
	/**
	* 
	*/
	class Relatorios
	{

		public static function gerarPdf(){

			include("./MPDF57/mpdf.php");
				
			$pdv = $_SESSION['pdv'];

			$pdo = MySql::conectarDb()->prepare("(SELECT DISTINCT entradas.descricao AS descricao, entradas.data AS data, entradas.valor AS valor,   CASE pdv.id WHEN $pdv THEN 'Entrada' END AS tipo FROM `tb_fin.pdv` AS pdv INNER JOIN `tb_fin.entradas`AS entradas ON pdv.id = entradas.pdv WHERE pdv.id = ? )UNION ALL (SELECT DISTINCT saidas.descricao AS descricao, saidas.data AS data, saidas.valor AS valor, CASE pdv.id WHEN $pdv THEN 'saída'  END AS tipo FROM `tb_fin.pdv` AS pdv INNER JOIN `tb_fin.saidas` AS saidas ON pdv.id = saidas.pdv WHERE pdv.id = ?) ORDER BY data ASC");
			$pdo->execute(array($pdv,$pdv));


			return $pdo->fetchAll();


		
	

	}


	}
?>