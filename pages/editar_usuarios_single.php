<?php
Painel::verificarPermissaoPagina(2);
	if (isset($_GET['id'])) {
		$id = (int)$_GET['id'];

		$usuario = Painel::select('tb_admin.usuario', 'id = ?', array($id));
		
	}else{
		Painel::alerta('erro', 'você precisa passar o parâmetro ID!');
		die();
	}
?>
	<div class="box-content">

		<h2><a href="editar_usuarios"><i class="fa fa-arrow-circle-left left"></i></a><i class="fa fa-user-plus"></i>Editar usuários</h2>
		<div class="clear"></div>

		<section class="cadastrar">
					<?php
						if (isset($_POST['atualizar'])) {
							if (Usuario::updateUsuario($_POST)) {
								Painel::alerta('sucesso','Usuário atualizado com sucesso!');
								$usuario = Painel::select('tb_admin.usuario', 'id = ?', array($id));
							}else{
								Painel::alerta('erro','Campos Vazios não são permitidos!');
						}
					}
						
					?>
				<div class="wraper-form">
					
					<form method="post" enctype="multipart/form-data">
						
						<input type="text" name="usuario" placeholder="Usuário" value="<?php echo $usuario['usuario']; ?>" />
						<input type="text" name="nome" placeholder="Nome Completo" value="<?php echo $usuario['nome']; ?>" />
						<input type="password" name="senha" placeholder="Senha" value="<?php echo $usuario['senha']; ?>"/>
						

						<div class="wraper-text">
							<label>Permissao</label>
							<select name="permissao" required >
								<?php
									if ($usuario['permissao'] == 1) {
										echo '<option value="1" selected>Comun</option>';
										echo '<option value="2">Administrador</option>';
									}elseif($usuario['permissao'] == 2){
										echo '<option value="1" >Comun</option>';
										echo '<option value="2" selected >Administrador</option>';
									}
								?>
								
							</select>
						</div>

						<div class="wraper-text">
							<label>Ativo ?</label>
							<select name="ativo" required >

								<?php
									if ($usuario['ativo'] == 1) {
										echo '<option value="1" selected>Sim</option>';
										echo '<option value="0">Não</option>';
									}elseif($usuario['ativo'] == 0){
										echo '<option value="1">Sim</option>';
										echo '<option value="0" selected>Não</option>';
									}
								?>
							</select>
						</div>
							<input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
							<input type="hidden" name="nome_tabela" value="tb_admin.usuario">
							<input type="submit" name="atualizar" value="Atualizar" />
					</form>
				</div>
		</section>
	</div>
</body>
</html>
