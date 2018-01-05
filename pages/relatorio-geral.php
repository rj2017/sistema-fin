
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