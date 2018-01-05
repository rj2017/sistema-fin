<?php
	Painel::verificarPermissaoPagina(1);

	$dateIni = date("Y-m-d");
	$dateFin = date("Y-m-d");


	if (isset($_POST['emitir'])) {

		$dateIni =$_POST['data-inicial'];
		$dateFin = $_POST['data-final'];

		Relatorios::relatorioGeral($dateIni, $dateFin);
		
	}



?>

<div class="box-content">
	<h2><i class="fa fa-cloud-download"></i>Emitir Relatório</h2>

	<div class="pesquisar-item2">
		<form method="post">
			<?php  ?>
			<input type="date" name="data-inicial" value="<?php echo $dateIni; ?>">
			<h2>à</h2>
			<input type="date" name="data-final" value="<?php echo $dateFin; ?>">
			<div class="wraper-form">
				<input type="submit" name="emitir" value="Emtir">
			</div>
	</form>
		
	</div>

</div>


</div>