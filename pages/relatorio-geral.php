
<style type="text/css">
	
	.wraper-table {
  overflow-x: auto; }

table {
  width: 100%;
  margin: 20px auto;
  max-width: 1280px; }
  table th {
    font-size: 16px;
    color: #FFFFFF;
    border-bottom: 3px solid #dfdfdf;
    background-color: #0097A7;
    text-align: center; }
  table td {
    font-size: 14px;
    color: #757575;
    padding: 2px;
    border-bottom: 1px solid #dfdfdf; }
  table a i {
    cursor: pointer;
    text-align: center; }
  table .fa-pencil {
    color: #FFC107 !important; }
  table .fa-times {
    color: #D32F2F !important; }
</style>
<?php 
	$dateIni =	$_SESSION['dataIni'];
	$dateFin = $_SESSION['dataFim'];

	$conteudo = Relatorios::relatorioGeral($dateIni, $dateFin );

	
?>
<div class="box-content">
	
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
				<?php  
					if(count($conteudo) == 0) {
							Painel::alerta('erro','Não foi localizado nenhum resultado para a data informada!');
						}
				?>
		</div><!-- wraper-table -->
</div>