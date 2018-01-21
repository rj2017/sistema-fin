<?php
Painel::verificarPermissaoPagina(1);

$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 10;

$parametro = Financeiro::selectParametro(($paginaAtual -1) * $porPagina,$porPagina);

?>
<div class="box-content">
	<h2><a href="parametrizacao"><i class="fa fa-arrow-circle-left left"></i></a><i class="fa fa-search"></i>Tipo<div class="btn-pesq"><i class="fa fa-search"></i></div></h2>
	
	<div class="clear"></div>
	<div class="pesquisar-item">
			<div class="wraper-form">
				<form method="post">
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
</div>

<div class="box-content">
		<div class="wraper-table">
				<table>
					<tr>

						<th>descrição</th>
						<th>ativo</th>
						<!-- <th>Excluir</th> -->
					</tr>
					
					<?php
						foreach ($parametro as $key => $value) {

							$id = $value['id'];
							$descricao = $value['descricao'];
							$ativo = $value['ativo'];

							if ($ativo == 1) {
								$ativo = 'Sim';
							}elseif ($ativo == 0) {
								$ativo = 'Não';
							}

							echo "<tr>";
								echo '<td>'.$descricao.'</td>';
								echo '<td>'.$ativo.'</td>';
								/*echo '<td><a activeBtn= "delete" href="'.INCLUDE_PATH.'parametrizacao?excluir='.$id.'"><i class="fa fa-times"></i></a></td>';*/
							echo "</tr>";


							
						}
					  ?>
				</table>
		</div><!-- wraper-table -->

		<div class="paginacao">
			<?php
				$totalPagina = ceil(count(Usuario::selectAll('tb_fin.parametro')) / $porPagina); //ceil: função em PHP que arredonda os numeros para um numero maior

				for ($i=1; $i <= $totalPagina; $i++) { 
					if ($i == $paginaAtual)
						echo '<a href="'.INCLUDE_PATH.'edit_tipo?pagina='.$i.'" class="pagina-active" >'.$i.'</a>';
					else
					echo '<a href="'.INCLUDE_PATH.'edit_tipo?pagina='.$i.'" >'.$i.'</a>';
				}
			?>
		</div><!-- paginacao -->

</div>