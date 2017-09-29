<?php
Painel::verificarPermissaoPagina(2);

?>
	<div class="box-content">
		<h2><i class="fa fa-user-plus"></i>Cadastro de PDVs</h2>

		<section class="cadastrar">
					<?php
						Usuario::cadastrarPdv();
						
					?>
				<div class="wraper-form">
					
					<form method="post" enctype="multipart/form-data">
						
						<input type="text" name="nome" placeholder="Nome:"  />

						<div class="wraper-text">
							<label>Ativo ?</label>
							<select name="ativo" required >
								<option value="1">Sim</option>
								<option value="0">Não</option>
							</select>
						</div>
			
							<input type="submit" name="cadastrar" value="cadastrar" />
					</form>
				</div>
		</section>
	</div>
</body>
</html>
