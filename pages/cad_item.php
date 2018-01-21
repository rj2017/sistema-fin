<?php 
Painel::verificarPermissaoPagina(1);


	Financeiro::CadastrarItem();
 ?>
<div class="box-content">
	<h2><a href="parametrizacao"><i class="fa fa-arrow-circle-left left"></i></a><i class="fa fa-gears"></i>Itens</h2>

	<section class="cadastrar">
					
				<div class="wraper-form">
					
					<form method="post">
						
						<input type="text" name="descricao" required placeholder="Descrição"  value="" />

						<div class="wraper-text">
							<label>Tipo</label>
							<select name="tipo" required id="tipo" >
								<option value="">-- Escolha um tipo --</option>

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

						<div class="wraper-text">
							<label>Sub-Tipo</label>
							<select name="sub-tipo" id="sub-tipo" required >

								
							</select>
						</div>

						<select name="ativo"  required>
							

								<?php
								if (isset($_GET['id'])) {

									if ($item['ativo'] == 1) {
										echo '<option value="1" selected>Sim</option>';
										echo '<option value="0">Não</option>';
									}elseif($item['ativo'] == 0){
										echo '<option value="1">Sim</option>';
										echo '<option value="0" selected>Não</option>';
									}

								}else{
								?>

								<option value="1">Ativo</option>
								<option value="0">Inativo</option>

								<?php
									}
								?>

						</select>


						<input type="text" name="valor" required placeholder="Valor:" id="money" />

						
							<div class="wraper-form">
								<input type="submit" name="enviar" value="Enviar" />
							</div>

					</form>
				</div>
		</section>

</div>
