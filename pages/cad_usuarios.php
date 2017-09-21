<?php
Painel::verificarPermissaoPagina(2);

?>
	<div class="box-content">
		<h2><i class="fa fa-user-plus"></i>Cadastro de usuários</h2>

		<section class="cadastrar">
					<?php
						Usuario::cadastrarUsuario();
						
					?>
				<div class="wraper-form">
					
					<form method="post" enctype="multipart/form-data">
						
						<input type="text" name="usuario" placeholder="Usuário"  />
						<input type="text" name="nome" placeholder="Nome Completo"  />
						<input type="password" name="senha" placeholder="Senha" />
						
						<div class="wraper-text">
							<label>Foto</label>
							<input type="file" name="imagem"/>
						</div>

						<div class="wraper-text">
							<label>Permissao</label>
							<select name="permissao" required >
								<option value="1">Comun</option>
								<option value="2">Administrador</option>
							</select>
						</div>

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
