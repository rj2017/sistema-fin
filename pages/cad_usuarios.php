<?php
Painel::verificarPermissaoPagina(2);
$pdo = MySql::conectarDb();
include('php/cad_user.php');
?>
	<div class="box-content">
		<h2><i class="fa fa-user-plus"></i>Cadastro de usuários</h2>

		<section class="cadastrar">
				<div class="wraper-form">
					<form method="post">
						
						<input type="text" name="usuario" placeholder="usuário"  />
						<input type="text" name="nome" placeholder="Nome Completo"  />
						<input type="password" name="senha" placeholder="senha" />
						<input type="password" name="senha2" placeholder="confirme a senha" />
						
						<div class="wraper-text">
							<label>Enviar imagem</label>
							<input type="file" name="img" />
						</div>

						<div class="wraper-text">
							<label>Permissao</label>
							<select name="ativo" required >
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
