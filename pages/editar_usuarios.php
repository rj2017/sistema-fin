<?php
	Painel::verificarPermissaoPagina(2);

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 10;

	if (isset($_POST['pesquisar'])) {

	$usuarios = Usuario::pesquisarUsuarios(($paginaAtual -1) * $porPagina, $porPagina);

	}else {
		$usuarios = Usuario::selectAll('tb_admin.usuario',($paginaAtual -1) * $porPagina,$porPagina);

	}

	if (isset($_GET['excluir'])) {
				
				$idExcluir = (int)$_GET['excluir'];

				Painel::delete('tb_admin.usuario', $idExcluir);
				Painel::redirect(INCLUDE_PATH.'editar_usuarios');

		}

	
?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i>Editar usuários<div class="btn-pesq"><i class="fa fa-search"></i></div></h2>
	
	<div class="clear"></div>
			<div class="wraper-form">
				<form method="post">
					<input type="text" name="usuario" placeholder="Usuario"/>
					<div class="wraper-text">
						<label>Ativo</label>
						<select name="ativo" >
							<option value="1">Sim</option>
							<option value="0">Não</option>
						</select>
					</div>
					<div class="wraper-text">
						<label>Permissão</label>
						<select name="permissao" >
							<option value="0">Todos</option>
							<option value="1">Comun</option>
							<option value="2">Administrador</option>
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

						<th>Usuário</th>
						<th>Nome</th>
						<th>Permissão</th>
						<th>Ativo</th>
						<th>Editar</th>
						<th>Deletar</th>

					</tr>
					
					<?php
						foreach ($usuarios as $key => $value) {
							$id = $value['id'];
							$user = $value['usuario'];
							$nome = $value['nome'];
							$permissao = $value['permissao'];
							$ativo = $value['ativo'];

							if ($permissao == 1) {
								$permissao = 'Comun';
							}elseif ($permissao == 2) {
								$permissao = 'Administrador';
							}

							if ($ativo == 1) {
								$ativo = 'Sim';
							}elseif ($ativo == 0) {
								$ativo = 'Não';
							}

							echo "<tr>";
								echo '<td>'.$user.'</td>';
								echo '<td>'.$nome.'</td>';
								echo '<td>'.$permissao.'</td>';
								echo '<td>'.$ativo.'</td>';
								echo '<td><a href="'.INCLUDE_PATH.'editar_usuarios_single?id='.$id.'"><i class="fa fa-pencil"></i></a></td>';
								echo '<td><a activeBtn= "delete" href="'.INCLUDE_PATH.'editar_usuarios?excluir='.$id.'"><i class="fa fa-times"></i></a></td>';
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