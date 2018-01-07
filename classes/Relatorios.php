<?php
	/**
	* 
	*/
	class Relatorios
	{


		public static function relatorioGeral($dataIni, $dataFin){

			$pdv = $_SESSION['pdv'];

			$pdo = MySql::conectarDb()->prepare("(SELECT DISTINCT entradas.descricao AS 'descricao', entradas.data AS 'data', entradas.valor AS 'valor',CASE entradas.pdv WHEN ? THEN 'Entrada' END AS tipo, parametros.descricao AS 'parametro', usuario.nome AS 'usuario'  FROM `tb_fin.entradas` AS entradas INNER JOIN `tb_fin.parametro` AS parametros ON entradas.parametro = parametros.id INNER JOIN `tb_admin.usuario` usuario ON entradas.usuario = usuario.id WHERE entradas.pdv = ? AND (entradas.data > ? and entradas.data < ?)) UNION ALL (SELECT DISTINCT saidas.descricao AS 'descricao', saidas.data AS 'data', saidas.valor AS 'valor',CASE saidas.pdv WHEN ? THEN 'Saida' END AS tipo, parametros.descricao AS 'parametro', usuario.nome AS 'usuario'  FROM `tb_fin.saidas` AS saidas INNER JOIN `tb_fin.parametro` AS parametros ON saidas.parametro = parametros.id INNER JOIN `tb_admin.usuario` usuario ON saidas.usuario = usuario.id WHERE saidas.pdv = ? AND (saidas.data > ? and saidas.data < ?)) ORDER BY data ASC");
			$pdo->execute(array($pdv, $pdv, $dataIni, $dataFin, $pdv, $pdv, $dataIni, $dataFin));

			return $pdo->fetchAll();


	}

	public static function emitirExcel($dateIni, $dateFin){

		$_SESSION['dataIni'] = $dateIni;
		$_SESSION['dataFim'] = $dateFin;

		$arquivo = 'relatorio-geral.xls';

			/*$html = '';
			$html .= '<table>';
			$html .= '<tr>';
			$html .= '<td colspan="3">Planilha de lançamentos</tr>';
			$html .= '</tr>';
			$html .= '<tr>';
			$html .= '<td><b>Descrição</b></td>';
			$html .= '<td><b>Data</b></td>';
			$html .= '<td><b>Valor</b></td>';
			$html .= '<td><b>Tipo</b></td>';
			$html .= '<td><b>Parâmetro</b></td>';
			$html .= '<td><b>Usuário</b></td>';
			$html .= '</tr>';

			foreach ($conteudo as $key => $value) {

				$descricao = $value['descricao'];
				$data = $value['data'];
				$valor = $value['valor'];
				$tipo = $value['tipo'];
				$parametro = $value['parametro'];
				$usuario = $value['usuario'];
				
				$html .= '<tr>';
				$html .= '<td>'.$descricao.'</td>';
				$html .= '<td>'.$data.'</td>';
				$html .= '<td>'.$valor.'</td>';
				$html .= '<td>'.$tipo.'</td>';
				$html .= '<td>'.$parametro.'</td>';
				$html .= '<td>'.$usuario.'</td>';
				$html .= '</tr>';
			}

			$html .= '</table>';

*/
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