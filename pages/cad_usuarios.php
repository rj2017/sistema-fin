<?php
$pdo = MySql::conectarDb();
include('php/cad_user.php');
?>
	<div class="box-content left w100">
		<section class="cadastrar">
				<div class="wraper-form">
					<form method="post">
						<p>Cadastro de usuários</p>
						<input type="text" name="usuario" placeholder="usuário"  />
						<input type="text" name="nome" placeholder="Nome Completo"  />
						<input type="password" name="senha" placeholder="senha" />
						<input type="password" name="senha2" placeholder="confirme a senha" />
						
						<div class="wraper-text">
							<label>Enviar imagem</label>
							<input type="file" name="img" />
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
