<?php
	/**
	* 
	*/
	class Relatorios
	{

		public static function relatorioEntradas(){
		
		$arquivo = date('Y-m-d').'.xls';
		// Criamos uma tabela HTML com o formato da planilha para excel
		$tabela = '<table border="1">';
		$tabela .= '<tr>';
		$tabela .= '	<td colspan=17><h1><b>Relatorio Protocolo "'.date('Y-m-d').'"</b></h1></tr>';
		$tabela .= '</tr>';
		$tabela .= '<tr>';
		$tabela .= '<td><b>Descrição</b></td>';
		$tabela .= '<td><b>Data</b></td>';
		$tabela .= '<td><b>Valor</b></td>';
		$tabela .= '</tr>';

		$resultado = MySql::conectarDb()->prepare("SELECT * FROM `tbb_fin.entradas` WHERE `id` = ?");
		$resultado->execute(array($_SESSION['pdv']));

		$resultado->fetchAll();

		foreach ($resultado as $key => $value) {
			
			  $id = $value['id'];		
			$insertsql = "UPDATE protocolo SET relatorio = '1' WHERE id = '" . $id . "' ;"; 
			mysql_query($insertsql) or die("erro mysql: ".mysql_error());		
		
			$tabela .= '<tr>';
			$tabela .= "<td style='mso-number-format:\@;'>".$dados['num_protocolo']."</td>";
			$tabela .= '<td>'.utf8_decode($value['descricao']).'</td>';
			$tabela .= '<td>'.utf8_decode($value['data']).'</td>';
			$tabela .= '<td>'.utf8_decode($value['valor']).'</td>';
			
			
			$tabela .= '</tr>';
		}

		$tabela .= '</table>';

		// Força o Download do Arquivo Gerado
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename={$arquivo}" );
		header ("Content-Description: PHP Generated Data" );

		echo $tabela;

	}


	}
?>