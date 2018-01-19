
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

	Painel::verificarPermissaoPagina(1);

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 20;

	$dateIni =	$_SESSION['dataIni'];
	$dateFin = $_SESSION['dataFim'];

	$conteudo = Relatorios::relatorioGeral($dateIni, $dateFin );

	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>


	<div class="wraper-table">
				<table>
					
					<tr>
						<th><b>Nome</b></th>
						<th><b>Parametro</b></th>
						<th><b>Sub-Parametro</b></th>
						<th><b>Tipo</b></th>
						<th><b>Data</b></th>
						<th><b>Usuário</b></th>
						<th><b>Quantidade</b></th>
						<th><b>Desconto</b></th>
						<th><b>Valor</b></th>
						<th><b>total</b></th>

					</tr>
					
					<?php


						foreach ($conteudo as $key => $value) {
							$descricao = $value['item'];
							$parametro = $value['parametro'];
							$sub = $value['subParametro'];
							$tipo = $value['tipo'];
							$data = date("d/m/Y",strtotime($value['data']));
							$qtn = $value['quantidade'];
							$desc = $value['desconto'];
							$valor = $value['valor'];
							$total = $value['total'];
							
							
							$usuario = $value['usuario'];

							echo "<tr>";
								echo '<td>'.$descricao.'</td>';
								echo '<td>'.$parametro.'</td>';
								echo '<td>'.$sub.'</td>';
								echo '<td>'.$tipo.'</td>';
								echo '<td>'.$data.'</td>';
								echo '<td>'.$usuario.'</td>';
								echo '<td>'.$qtn.'</td>';
								echo '<td> R$ '.number_format($desc, 2, ',', ' ').'</td>';
								echo '<td> R$ '.number_format($valor, 2, ',', ' ').'</td>';
								echo '<td> R$ '.number_format($total, 2, ',', ' ').'</td>';
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

</body>
</html>
