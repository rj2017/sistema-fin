<?php
Painel::verificarPermissaoPagina(1);

?>
	<div class="box-content">
		<h2><i class="fa fa-plus"></i>Entradas</h2>

		<section class="cadastrar">
					<?php
						Financeiro::entrada();
					
					?>
				<div class="wraper-form">
					
					<form method="post">
						
						<input type="text" name="descricao" required placeholder="Descrição:"  />
						<input type="date" name="data" required placeholder="Data:"  value="<?php echo date ("Y-m-d"); ?>"  />
						<input type="text" name="valor" required placeholder="Valor:" id="money" />
							<div class="wraper-form">
								<input type="submit" name="enviar" value="Enviar" />
							</div>

					</form>
				</div>
		</section>
</div>

