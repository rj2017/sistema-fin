<?php
	/**
	* 
	*/
	class Relatorios
	{


		public static function relatorioGeral($dataIni, $dataFin){

			$pdv = $_SESSION['pdv'];
			@$tipo = $_POST['tipo'];
			@$parametro = $_POST['parametro'];

			if ($tipo == '') {
					
				if ($parametro == '') {

					$pdo = MySql::conectarDb()->prepare("(SELECT a.id AS id,d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro,CASE a.pdv WHEN ? THEN 'Entrada' END AS tipo, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, e.nome AS usuario  FROM `tb_fin.entradas` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id INNER JOIN `tb_admin.usuario` AS e ON a.usuario = e.id WHERE a.pdv = ? AND (a.data >= ? AND a.data <= ?)) UNION ALL (SELECT a.id AS id,d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro,CASE a.pdv WHEN ? THEN 'Saida' END AS tipo, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, e.nome AS usuario  FROM `tb_fin.saidas` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id INNER JOIN `tb_admin.usuario` AS e ON a.usuario = e.id WHERE a.pdv = ? AND (a.data >= ? AND a.data <= ?) ) ORDER BY data ASC");
				$pdo->execute(array($pdv, $pdv, $dataIni, $dataFin, $pdv, $pdv, $dataIni, $dataFin));
					

					}
				else{

				$pdo = MySql::conectarDb()->prepare("(SELECT a.id AS id,d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro,CASE a.pdv WHEN ? THEN 'Entrada' END AS tipo, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, e.nome AS usuario  FROM `tb_fin.entradas` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id INNER JOIN `tb_admin.usuario` AS e ON a.usuario = e.id WHERE a.pdv = ? AND (a.data >= ? AND a.data <= ?) AND a.parametro = ?) UNION ALL (SELECT a.id AS id,d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro,CASE a.pdv WHEN ? THEN 'Saida' END AS tipo, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, e.nome AS usuario  FROM `tb_fin.saidas` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id INNER JOIN `tb_admin.usuario` AS e ON a.usuario = e.id WHERE a.pdv = ? AND (a.data >= ? AND a.data <= ?) AND a.parametro = ? ) ORDER BY data ASC");
				$pdo->execute(array($pdv, $pdv, $dataIni, $dataFin, $parametro, $pdv, $pdv, $dataIni, $dataFin, $parametro));

				}

			}elseif ($tipo == 1) {

					if ($parametro == '') {
						$pdo = MySql::conectarDb()->prepare("SELECT a.id AS id,d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro,CASE a.pdv WHEN ? THEN 'Entrada' END AS tipo, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, e.nome AS usuario  FROM `tb_fin.entradas` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id INNER JOIN `tb_admin.usuario` AS e ON a.usuario = e.id WHERE a.pdv = ? AND (a.data >= ? AND a.data <= ?) ORDER BY data ASC");
					$pdo->execute(array($pdv, $pdv, $dataIni, $dataFin));
					}else{

					$pdo = MySql::conectarDb()->prepare("SELECT a.id AS id,d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro,CASE a.pdv WHEN ? THEN 'Entrada' END AS tipo, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, e.nome AS usuario  FROM `tb_fin.entradas` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id INNER JOIN `tb_admin.usuario` AS e ON a.usuario = e.id WHERE a.pdv = ? AND (a.data >= ? AND a.data <= ?) AND a.parametro = ?  ORDER BY data ASC");
					$pdo->execute(array($pdv, $pdv, $dataIni, $dataFin, $parametro));
				}
				
			}elseif ($tipo == 2) {

				if ($parametro == '') {
					$pdo = MySql::conectarDb()->prepare("SELECT a.id AS id,d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro,CASE a.pdv WHEN ? THEN 'Saida' END AS tipo, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, e.nome AS usuario  FROM `tb_fin.saidas` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id INNER JOIN `tb_admin.usuario` AS e ON a.usuario = e.id WHERE a.pdv = ? AND (a.data >= ? AND a.data <= ?) ORDER BY data ASC");
					$pdo->execute(array($pdv, $pdv, $dataIni, $dataFin));
					}else{


					$pdo = MySql::conectarDb()->prepare("SELECT a.id AS id,d.descricao AS item, c.descricao AS parametro, b.descricao AS subParametro,CASE a.pdv WHEN ? THEN 'Saida' END AS tipo, a.data AS data, a.quantidade AS quantidade, a.desconto AS desconto, a.valor AS valor, a.total AS total, a.pdv AS pdv, e.nome AS usuario  FROM `tb_fin.saidas` AS a INNER JOIN `tb_fin.sub-parametro` AS b ON a.sub_parametro = b.id INNER JOIN `tb_fin.parametro` AS c ON b.parametro = c.id INNER JOIN `tb_fin.itens` AS d ON a.item = d.id INNER JOIN `tb_admin.usuario` AS e ON a.usuario = e.id WHERE a.pdv = ? AND (a.data >= ? AND a.data <= ?) AND a.parametro = ? ORDER BY data ASC");
					$pdo->execute(array($pdv, $pdv, $dataIni, $dataFin, $parametro));
				}

			}

			return $pdo->fetchAll();


	}

	public static function emitirExcel($dateIni, $dateFin){

		$_SESSION['dataIni'] = $dateIni;
		$_SESSION['dataFim'] = $dateFin;

		$arquivo = 'relatorio-geral.xls';

			
			
			// Envia o conteúdo do arquivo

		/*$arquivo = 'relatorio-geral.xls';

			
			header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header ("Last-Modified: " . gmdate("D,d M Y H:i:s") . " GMT");
			header ("Cache-Control: no-cache, must-revalidate");
			header ("Pragma: no-cache");
			header ("Content-type: application/x-msexcel");
			header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
			header ("Content-Description: PHP Generated Data" );
			// Envia o conteúdo do arquivo

			ob_start();
			include ("pages/relatorio-geral.php");
			$conteudo = ob_get_contents();
			ob_end_clean();
			echo $conteudo;
			exit;*/
			
			$nomeArquivo ='relatorioGeral-'.$_SESSION['user'].'.xls'; 
			$arquivoLocal = 'download/'.$nomeArquivo;



			ob_start();
			include ("pages/relatorio-geral.php");
			$conteudo = ob_get_contents();
			ob_end_clean();

			$file = fopen($arquivoLocal,'w+');
			fwrite($file, $conteudo);			
			fclose($file);
			echo '<div class="box-content"><a href= download/relatorioGeral-'.$_SESSION['user'].'.xls download>Clique aqui para fazer o download</a></div>';
			exit;
			
			
	}

	public static function emitirPdf($dateIni, $dateFin){

			$_SESSION['dataIni'] = $dateIni;
			$_SESSION['dataFim'] = $dateFin;

			ob_start();
			include ("pages/relatorio-geral.php");
			$conteudo = ob_get_contents();
			ob_end_clean();

			
			$mpdf=new mPDF();
			$mpdf->WriteHTML($conteudo);
			$mpdf->Output();
			exit;
								


	}
}
?>