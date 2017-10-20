<?php
	Painel::verificarPermissaoPagina(1);
	$dateIni = date("Y-m-d");
	$dateFin = date("Y-m-d");

	if (isset($_POST['emitir'])) {


		$dateIni =$_POST['data-inicial'];
		$dateFin = $_POST['data-final'];
		$relatorios = Relatorios::gerarPdf();

	}
?>

<div class="box-content">
	<h2><i class="fa fa-cog"></i>Página em construção</h2>

			<div class="wraper-form">
				<form method="post">
					<div class="wraper-data">
						<input type="date" name="data-inicial" value="<?php echo $dateIni; ?>">
						<h2>à</h2>
						<input type="date" name="data-final" value="<?php echo $dateFin; ?>">
					</div>
	

				<input type="submit" name="emitir" value="Emitir" />
				</form>
			</div>
	
</div>