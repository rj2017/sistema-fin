
<?php
	Painel::verificarPermissaoPagina(1);
/*	$dateIni = date("Y-m-d");
	$dateFin = date("Y-m-d");

	if (isset($_POST['emitir'])) {


		$dateIni =$_POST['data-inicial'];
		$dateFin = $_POST['data-final'];
		$relatorios = Relatorios::gerarPdf();

	}*/
	$relatorios = Relatorios::gerarPdf();
?>

<!-- <div class="box-content">
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
	
</div> -->
<style type="text/css">
	/** tabela responsiva */
	table {
  width: 100%;
  margin: 20px auto;
  max-width: 1280px; }
  table th {
    font-weight: bold;
    font-size: 20px;
    color: #FFFFFF;
    border-bottom: 3px solid #dfdfdf;
    background-color: #0097A7;
    text-align: center; }
  table td {
    font-size: 20px;
    color: #757575;
    padding: 2px;
    border-bottom: 1px solid #dfdfdf;
    text-align: center; }
  table a i {
    cursor: pointer;
    text-align: center; }
  table .fa-pencil {
    color: #FFC107 !important; }
  table .fa-times {
    color: #D32F2F !important; }
</style>

<div class="box-content">
	<h2 style="text-align: center;">Relatório Geral de Lançamentos</h2>
	<div class="wraper-table">
				<table>
					<tr>

						<th>Nome</th>
						<th>Data</th>
						<th>Valor</th>
						<th>Tipo</th>

					</tr>
					
					<?php
						foreach ($relatorios as $key => $value) {
							$nome = $value['descricao'];
							$data = $value['data'];
							$valor = $value['valor'];
							$tipo = $value['tipo'];

							echo "<tr>";
								echo '<td>'.$nome.'</td>';
								echo '<td>'.date('d/m/Y',  strtotime($data)).'</td>';
								echo '<td> R$ '.$valor.'</td>';
								echo '<td>'.$tipo.'</td>';
							echo "</tr>";


							
						}
					  ?>
				</table>
		</div><!-- wraper-table -->
</div>