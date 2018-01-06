
<!DOCTYPE html>
<html>
<head>
	<title>Excel</title>
	<meta charset="utf-8">
</head>
<body>
<?php
$arquivo = 'relatorio-geral.xls';
			$html = '';
			$html .= '<table border="1">';
			$html .= '<tr>';
			$html .= '<td colspan="6">Planilha de lançamentos</tr>';
			$html .= '</tr>';
			$html .= '<tr>';
			$html .= '<td><b>Descrição</b></td>';
			$html .= '<td><b>Data</b></td>';
			$html .= '<td><b>Valor</b></td>';
			$html .= '<td><b>Tipo</b></td>';
			$html .= '<td><b>Parâmetro</b></td>';
			$html .= '<td><b>Usuário</b></td>';
			$html .= '</tr>';

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

?>


</body>
</html>