<?php
	/**
	* 
	*/
	class Relatorios
	{

		public static function gerarPdf(){

			include("./MPDF57/mpdf.php");
				
			$pdv = $_SESSION['pdv'];
			$dataIni = $_POST['data-inicial'];
			$dataFin = $_POST['data-final'];

			$pdo = MySql::conectarDb()->prepare("(SELECT DISTINCT entradas.descricao, entradas.data, entradas.valor,   CASE pdv.id WHEN $pdv THEN 'Entradas' END AS tipo FROM `tb_fin.pdv` AS pdv INNER JOIN `tb_fin.entradas`AS entradas ON pdv.id = entradas.pdv WHERE pdv.id = ? AND (entradas.data >= ? AND entradas.data <= ? ))UNION ALL (SELECT DISTINCT saidas.descricao, saidas.data, saidas.valor, CASE pdv.id WHEN $pdv THEN 'saídas'  END AS tipo FROM `tb_fin.pdv` AS pdv INNER JOIN `tb_fin.saidas` AS saidas ON pdv.id = saidas.pdv WHERE pdv.id = ? AND (saidas.data >= ? AND saidas.data <= ? ))");
			$pdo->execute(array($pdv,$dataIni,$dataFin,$pdv,$dataIni,$dataFin));

			$pdo->fetchAll();

			return print_r($pdo);

			/*$mpdf = new mPDF();
			//tamanho da tela
			$mpdf->SetDisplayMode("fullpage");
			//cabeçalho
			$mpdf->WriteHTML();
			//saída
			$mpdf->Output();
			exit();*/




		
	

	}


	}
?>