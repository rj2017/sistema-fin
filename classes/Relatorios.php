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

	public static function emitirExcel($conteudo){
		$arquivo = 'relatorio-geral.xls';
			$html = '';
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

			header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header ("Last-Modified: " . gmdate("D,d M Y H:i:s") . " GMT");
			header ("Cache-Control: no-cache, must-revalidate");
			header ("Pragma: no-cache");
			header ("Content-type: application/x-msexcel");
			header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
			header ("Content-Description: PHP Generated Data" );
			// Envia o conteúdo do arquivo
			echo $html;
			exit;
	}

	public static function emitirPdf($conteudo){

			$html = '<table border=1';	
			$html .= '<thead>';
			$html .= '<tr>';
			$html .= '<td><b>Descrição</b></td>';
			$html .= '<td><b>Data</b></td>';
			$html .= '<td><b>Valor</b></td>';
			$html .= '<td><b>Tipo</b></td>';
			$html .= '<td><b>Parâmetro</b></td>';
			$html .= '<td><b>Usuário</b></td>';
			$html .= '</tr>';
			$html .= '</thead>';
			$html .= '<tbody>';
			
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
			
			$html .= '</tbody>';
			$html .= '</table';

			//referenciar o DomPDF com namespace
			 use Dompdf\Dompdf;

			// include autoloader
			require_once("dompdf/autoload.inc.php");

			//Criando a Instancia
			$dompdf = new DOMPDF();
			
			// Carrega seu HTML
			$dompdf->load_html('
					<h1 style="text-align: center;">Celke - Relatório de lançamentos</h1>
					'. $html .'
				');

			//Renderizar o html
			$dompdf->render();

			//Exibibir a pÃ¡gina
			$dompdf->stream(
				"relatorio_celke.pdf", 
				array(
					"Attachment" => true //Para realizar o download somente alterar para true
				)
			);


	}

}
?>