<?php
	Painel::verificarPermissaoPagina(1);

	if (isset($_GET['emitir'])) {

		ob_start();
		include('relatorio-geral.php');
		$conteudo = ob_get_contents();
		ob_end_clean();

		$mpdf = new mPDF();
		//tamanho da tela
		$mpdf->SetDisplayMode("fullpage");
		//cabeçalho
		$mpdf->WriteHTML($conteudo);
		//saída
		$mpdf->Output();
		exit();
	}



?>
<div class="box-content">
	<h2><i class="fa fa-cloud-download"></i>Emitir Relatório</h2>

	<div class="wraper-relatorios">
			<a href="relatorios?emitir">
				<div class="single-relatorios">
					<i class="fa fa-edit"></i>
					<h2>Lançamentos Gerais</h2>
				</div>
			</a>
		</div>

		<p style="color: red;">O Relatório não funciona no Chrome!</p>
</div>