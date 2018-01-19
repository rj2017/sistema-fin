<?php
	Painel::verificarPermissaoPagina(2);

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 10;

	if (isset($_POST['pesquisar'])) {

	$pdv = Usuario::pesquisarPdvUsuario(($paginaAtual -1) * $porPagina, $porPagina);

	}else {
		$pdv = Usuario::selectAllPdvUsuario(($paginaAtual -1) * $porPagina,$porPagina);

	}

	if (isset($_GET['excluir'])) {
				
				$idExcluir = (int)$_GET['excluir'];

				Painel::delete('tb_fin.usuario-pdv', $idExcluir);
				Painel::redirect(INCLUDE_PATH.'editar_pdv_usuario');

		}

	
?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i>PDVs x Usuários<div class="btn-pesq"><i class="fa fa-search"></i></div></h2>
	
	<div class="clear"></div>
			<div class="wraper-form">
				<form method="post">
					<input list="pdvs" name="pdv" placeholder="PDV:" id="input">

					  <datalist id="pdvs">
					  	<?php
					  		$option = Usuario::selectAll('tb_fin.pdv');

					  		foreach ($option as $key => $value) {
					  			$id = $value['id'];
					  			$nome = $value['nome'];

					  			echo '<option value="'.$id.' - '.$nome.'">';
					  		}
					  	?>
					  </datalist>

					  <input list="usuarios" name="usuario" placeholder="Usuário:" id="input">

					  <datalist id="usuarios">
					    <?php
					  		$option = Usuario::selectAll('tb_admin.usuario');

					  		foreach ($option as $key => $value) {
					  			$id = $value['id'];
					  			$nome = $value['nome'];

					  			echo '<option value="'.$id.' - '.$nome.'">';
					  		}
					  	?>
					  </datalist>

					  <div></div>
				<input type="submit" name="pesquisar" value="Pesquisar" />
				</form>
			</div>
</div>

<div class="box-content">
		<div class="wraper-table">
				<table>
					<tr>

						<th>PDV</th>
						<th>Usuário</th>
						<th>Deletar</th>

					</tr>
					
					<?php

						foreach ($pdv as $key => $value) {
							$id = $value['id'];
							$pdv = $value['nome-pdv'];
							$usuario = $value['nome-usuario'];


							echo "<tr>";
								echo '<td>'.$pdv.'</td>';
								echo '<td>'.$usuario.'</td>';
								echo '<td><a activeBtn= "delete" href="'.INCLUDE_PATH.'editar_pdv_usuario?excluir='.$id.'"><i class="fa fa-times"></i></a></td>';
							echo "</tr>";


							
						}
					  ?>
				</table>
		</div><!-- wraper-table -->

		<div class="paginacao">
			<?php
				$totalPagina = ceil(count(Usuario::selectAllPdvUsuario()) / $porPagina); //ceil: função em PHP que arredonda os numeros para um numero maior

				for ($i=1; $i <= $totalPagina; $i++) { 
					if ($i == $paginaAtual)
						echo '<a href="'.INCLUDE_PATH.'editar_pdv_usuario?pagina='.$i.'" class="pagina-active" >'.$i.'</a>';
					else
					echo '<a href="'.INCLUDE_PATH.'editar_pdv_usuario?pagina='.$i.'" >'.$i.'</a>';
				}
			?>
		</div><!-- paginacao -->

</div>