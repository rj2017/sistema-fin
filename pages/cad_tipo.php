<?php 
Painel::verificarPermissaoPagina(1);

$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 10;

$parametro = Financeiro::selectParametro(($paginaAtual -1) * $porPagina,$porPagina);

/*if (isset($_GET['excluir'])) {
				
				$idExcluir = (int)$_GET['excluir'];

				Painel::delete('tb_fin.parametro', $idExcluir);
				Painel::redirect(INCLUDE_PATH.'parametrizacao');

		}*/

 ?>
<div class="box-content">
	<h2><a href="parametrizacao"><i class="fa fa-arrow-circle-left left"></i></a><i class="fa fa-gears"></i>Tipo</h2>

	<section class="cadastrar">
					<?php
						Financeiro::CadastrarParametros();
					
					?>
				<div class="wraper-form">
					
					<form method="post">
						
						<input type="text" name="descricao" required placeholder="Descrição"  />

						<select name="ativo"  required>
							<option value="1">Ativo</option>
							<option value="0">Inativo</option>
						</select>

							<div class="wraper-form">
								<input type="submit" name="enviar" value="Enviar" />
							</div>

					</form>
				</div>
		</section>

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
						echo '<a href="'.INCLUDE_PATH.'parametrizacao?pagina='.$i.'" class="pagina-active" >'.$i.'</a>';
					else
					echo '<a href="'.INCLUDE_PATH.'parametrizacao?pagina='.$i.'" >'.$i.'</a>';
				}
			?>
		</div><!-- paginacao -->

</div>