<?php
Painel::verificarPermissaoPagina(1);

$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 10;

if (isset($_POST['pesquisar'])) {

	$item = Financeiro::pesquisarItens('', ($paginaAtual -1) * $porPagina,$porPagina);

}else{
	$item = Financeiro::selectItem('', ($paginaAtual -1) * $porPagina,$porPagina);
}




?>

<div class="box-content">
	<h2><a href="parametrizacao"><i class="fa fa-arrow-circle-left left"></i></a><i class="fa fa-search"></i>Itens<div class="btn-pesq"><i class="fa fa-search"></i></div></h2>
	
	<div class="clear"></div>
		
			<div class="wraper-form">
				<form method="post">
					
					<input type="text" name="cod" placeholder="Código: "/>
					<input type="text" name="nome" placeholder="Nome: "/>


					<div class="wraper-text">
						<label>Ativo</label>
						<select name="ativo" >
							<option value="1">Sim</option>
							<option value="0">Não</option>
						</select>
					</div>
	

				<input type="submit" name="pesquisar" value="Pesquisar" />
				</form>
			</div>
		
</div>

<div class="box-content">
		<div class="wraper-table">
				<table>
					<tr>

						<th>Código</th>
						<th>Descrição</th>
						<th>Valor</th>
						<th>Ativo</th>
						<!-- <th>Editar</th> -->

					</tr>
					
					<?php

						foreach ($item as $key => $value) {

							$id = $value['id'];
							$descricao = $value['descricao'];
							$valor = $value['valor'];
							$ativo = $value['ativo'];

							if ($ativo == 1) {
								$ativo = 'Sim';
							}elseif ($ativo == 0) {
								$ativo = 'Não';
							}


							echo "<tr>";
								echo '<td>'.$id.'</td>';
								echo '<td>'.$descricao.'</td>';
								echo '<td>R$ '. number_format($valor, 2, ',', '.').'</td>';
								echo '<td>'.$ativo.'</td>';
								/*echo '<td><a href="'.INCLUDE_PATH.'cad_item?id='.$id.'"><i class="fa fa-pencil"></i></a></td>';*/
							echo "</tr>";


							
						}
					  ?>
				</table>
		</div><!-- wraper-table -->

	<div class="paginacao">
			<?php
				$totalPagina = ceil(count(Usuario::selectAll('tb_fin.itens')) / $porPagina); //ceil: função em PHP que arredonda os numeros para um numero maior

				for ($i=1; $i <= $totalPagina; $i++) { 
					if ($i == $paginaAtual)
						echo '<a href="'.INCLUDE_PATH.'edit_item?pagina='.$i.'" class="pagina-active" >'.$i.'</a>';
					else
					echo '<a href="'.INCLUDE_PATH.'edit_item?pagina='.$i.'" >'.$i.'</a>';
				}
			?>
		</div><!-- paginacao -->

</div>