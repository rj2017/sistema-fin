<?php
	Painel::verificarPermissaoPagina(1);

	$dateIni = date("Y-m-d");
	$dateFin = date("Y-m-d");

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 10;

	$html = '';

	$conteudo = Relatorios::relatorioGeral($dateIni, $dateFin);

	if (isset($_POST['emitir'])) {

		$dateIni =$_POST['data-inicial'];
		$dateFin = $_POST['data-final'];

	$conteudo = Relatorios::relatorioGeral($dateIni, $dateFin);
		
	}

	if (isset($_POST['excel'])){

		$dateIni =$_POST['data-inicial'];
		$dateFin = $_POST['data-final'];

		Relatorios::emitirExcel($dateIni, $dateFin);
		
	}
	if (isset($_POST['pdf'])){

		$dateIni =$_POST['data-inicial'];
		$dateFin = $_POST['data-final'];

		Relatorios::emitirPdf($dateIni, $dateFin);
		
	}



?>

<div class="box-content">
	<h2><i class="fa fa-cloud-download"></i>Emitir Relatório</h2>

	<div class="wraper-form">
		<form method="post" target="_blank">
			<div class="pesquisar-item2 ">
				<input type="date" name="data-inicial" value="<?php echo $dateIni; ?>">
				<h2>à</h2>
				<input type="date" name="data-final" value="<?php echo $dateFin; ?>">
			</div>
			
		<div class="wraper-text">
			<label>Tipo</label>
			<select name="tipo">
				<option value="">Ambos</option>
				<option value="1">Entradas</option>
				<option value="2">Saídas</option>
			</select>
		</div>

		<div class="wraper-text">
			<label>Parametro</label>
			<select name="parametro" >

				<option value="">-- Escolha um tipo --</option>

				<?php
			  		$option = Usuario::selectAll('tb_fin.parametro');

			  		foreach ($option as $key => $value) {
			  			$id = $value['id'];
			  			$nome = $value['descricao'];

			  			echo '<option value="'.$id.'">'.$nome.'</option>';
			  		}
			  	?>
	
			</select>
		</div>


			<div class="emitir-rel">
				<input type="submit" name="excel" value="Gerar excel">
				<input type="submit" name="pdf" value="Gerar PDF">

			</div>

			
	</form>

		<p style="color: red">O relatório em PDF não funciona no Chrome!</p>		
	</div>
	

</div>

