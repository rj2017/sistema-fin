<?php
	Painel::verificarPermissaoPagina(2);

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 10;

	if (isset($_POST['pesquisar'])) {

	$pdv = Usuario::pesquisarPdv(($paginaAtual -1) * $porPagina, $porPagina);

	}else {
		$pdv = Usuario::selectAll('tb_fin.pdv',($paginaAtual -1) * $porPagina,$porPagina);

	}

	if (isset($_GET['excluir'])) {
				
				$idExcluir = (int)$_GET['excluir'];

				Painel::delete('tb_fin.pdv', $idExcluir);
				Painel::redirect(INCLUDE_PATH.'editar_pdv');

		}

	
?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i>Editar PDVs<div class="btn-pesq"><i class="fa fa-search"></i></div></h2>
	
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
		</div><!-- pesquisar-usuario -->
</div>

<div class="box-content">
		<div class="wraper-table">
				<table>
					<tr>

						<th>Nome</th>
						<th>Ativo</th>
						<th>Editar</th>
						<th>Deletar</th>

					</tr>
					
					<?php

						foreach ($pdv as $key => $value) {
							$id = $value['id'];
							$nome = $value['nome'];
							$ativo = $value['ativo'];

							if ($ativo == 1) {
								$ativo = 'Sim';
							}elseif ($ativo == 0) {
								$ativo = 'Não';
							}

							echo "<tr>";
								echo '<td>'.$nome.'</td>';
								echo '<td>'.$ativo.'</td>';
								echo '<td><a href="'.INCLUDE_PATH.'editar_pdv_single?id='.$id.'"><i class="fa fa-pencil"></i></a></td>';
								echo '<td><a activeBtn= "delete" href="'.INCLUDE_PATH.'editar_pdv?excluir='.$id.'"><i class="fa fa-times"></i></a></td>';
							echo "</tr>";


							
						}
					  ?>
				</table>
		</div><!-- wraper-table -->

		<div class="paginacao">
			<?php
				$totalPagina = ceil(count(Usuario::selectAll('tb_admin.usuario')) / $porPagina); //ceil: função em PHP que arredonda os numeros para um numero maior

				for ($i=1; $i <= $totalPagina; $i++) { 
					if ($i == $paginaAtual)
						echo '<a href="'.INCLUDE_PATH.'editar_usuarios?pagina='.$i.'" class="pagina-active" >'.$i.'</a>';
					else
					echo '<a href="'.INCLUDE_PATH.'editar_usuarios?pagina='.$i.'" >'.$i.'</a>';
				}
			?>
		</div><!-- paginacao -->

</div>