<?php 
Painel::verificarPermissaoPagina(1);



/*if (isset($_GET['excluir'])) {
				
				$idExcluir = (int)$_GET['excluir'];

				Painel::delete('tb_fin.parametro', $idExcluir);
				Painel::redirect(INCLUDE_PATH.'parametrizacao');

		}*/

 ?>
<div class="box-content">
	<h2><a href="parametrizacao"><i class="fa fa-arrow-circle-left left"></i></a><i class="fa fa-gears"></i>Sub-Parâmetro</h2>

	<section class="cadastrar">
					<?php
						Financeiro::CadastrarSubParametros();
					
					?>
				<div class="wraper-form">
					
					<form method="post">
						
						<input type="text" name="descricao" required placeholder="Descrição"  />

						<div class="wraper-text">
							<label>Tipo</label>
							<select name="tipo" required >

								<?php
							  		$option = Usuario::selectAll('tb_fin.parametro');

							  		foreach ($option as $key => $value) {
							  			$id = $value['id'];
							  			$nome = $value['descricao'];

							  			echo '<option value="'.$id.'">'.$nome.'</option>';
							  		}
							  	?>
							</select>
						</div>

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
