<?php
	Painel::verificarPermissaoPagina(1);

	$dateIni = date("Y-m-d");
	$dateFin = date("Y-m-d");

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 10;


	$conteudo = Relatorios::relatorioGeral($dateIni, $dateFin);

	if (isset($_POST['emitir'])) {

		$dateIni =$_POST['data-inicial'];
		$dateFin = $_POST['data-final'];

		$conteudo = Relatorios::relatorioGeral($dateIni, $dateFin);
		
	}

	if (isset($_GET['excel'])){

		Relatorios::emitirExcel($conteudo);
		
	}
	if (isset($_GET['pdf'])){

		Relatorios::emitirPdf($conteudo);
		
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

<div class="box-content">
	<div class="emitir-rel">
		<a href="relatorios?excel"><i class="fa fa-file-excel-o"></i>Gerar excel</a>
		<a href="relatorios?pdf"><i class="fa fa-file-excel-o"></i>Gerar PDF</a>
	</div>
		<div class="wraper-table">
				<table>
					<tr>

						<th>Descrição</th>
						<th>Data</th>
						<th>Valor</th>
						<th>Tipo</th>
						<th>Parâmetro</th>
						<th>Usuário</th>

					</tr>
					
					<?php

						foreach ($conteudo as $key => $value) {
							$descricao = $value['descricao'];
							$data = $value['data'];
							$valor = $value['valor'];
							$tipo = $value['tipo'];
							$parametro = $value['parametro'];
							$usuario = $value['usuario'];

							echo "<tr>";
								echo '<td>'.$descricao.'</td>';
								echo '<td>'.$data.'</td>';
								echo '<td>'.$valor.'</td>';
								echo  '<td>'.$tipo.'</td>';
								echo '<td>'.$parametro.'</td>';
								echo '<td>'.$usuario.'</td>';
							echo "</tr>";


							
						}
					  ?>
				</table>
		</div><!-- wraper-table -->

	<div class="paginacao">
			<?php
				$totalPagina = ceil(count(Usuario::selectAll('tb_fin.entradas')+Usuario::selectAll('tb_fin.saidas')) / $porPagina); //ceil: função em PHP que arredonda os numeros para um numero maior

				for ($i=1; $i <= $totalPagina; $i++) { 
					if ($i == $paginaAtual)
						echo '<a href="'.INCLUDE_PATH.'relatorios?pagina='.$i.'" class="pagina-active" >'.$i.'</a>';
					else
					echo '<a href="'.INCLUDE_PATH.'relatorios?pagina='.$i.'" >'.$i.'</a>';
				}
			?>
	</div><!-- paginacao -->
</div>