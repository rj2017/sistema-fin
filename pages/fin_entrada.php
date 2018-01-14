<?php
Painel::verificarPermissaoPagina(1);

?>

	<div class="box-content">
		<h2><i class="fa fa-plus"></i>Entradas</h2>
		<div class="wrap-cod">
			<form method="post">
			
					<input type="number" name="cod" placeholder="Código">
					<div class="item-cod"><a href=""><i class="fa fa-search"></i></a></div>
			
			</form>
		</div>
		<div class="clear"></div>
	</div>


	<div class="box-content">
		

		<section class="cadastrar">
					<?php
						Financeiro::entrada();
					
					?>
				<div class="wraper-form">
					
					<form method="post">

						
						
						<input type="text" name="descricao" required placeholder="Descrição:"  />

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
						<div class="wraper-text">
							<label>Sub-Tipo</label>
							<select name="tipo" required >

								<?php
							  		/*$option2 = Financeiro::selectAll('tb_fin.sub-parametro');*/

							  		foreach ($option as $key => $value) {
							  			$id = $value['id'];
							  			$nome = $value['descricao'];

							  			echo '<option value="'.$id.'">'.$nome.'</option>';
							  		}
							  	?>
							</select>
						</div>

						
						
						<input type="date" name="data" required placeholder="Data:"  value="<?php echo date ("Y-m-d"); ?>"  />

						<div class="wraper-text">
							<label>Quantidade:</label>
							<input type="number" name="quantidade" value="1" required="" />
						</div>

						<input type="text" name="desconto" required placeholder="Desconto:" id="money"  />

						
						<input type="text" name="valor" required placeholder="Valor:" id="money" />

						

							<div class="wraper-form">
								<input type="submit" name="enviar" value="Enviar" />
							</div>

					</form>
				</div>
		</section>
</div>

