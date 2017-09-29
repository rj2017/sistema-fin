<?php
Painel::verificarPermissaoPagina(2);
	if (isset($_GET['id'])) {
		$id = (int)$_GET['id'];

		$pdv = Painel::select('tb_fin.pdv', 'id = ?', array($id));
		
	}else{
		Painel::alerta('erro', 'você precisa passar o parâmetro ID!');
		die();
	}
?>
	<div class="box-content">

		<h2><a href="editar_pdv"><i class="fa fa-arrow-circle-left left"></i></a><i class="fa fa-user-plus"></i>Editar Pdv</h2>
		<div class="clear"></div>

		<section class="cadastrar">
					<?php
						if (isset($_POST['atualizar'])) {
							if (Usuario::updateItem($_POST)) {
								Painel::alerta('sucesso','Usuário atualizado com sucesso!');
								$pdv = Painel::select('tb_fin.pdv', 'id = ?', array($id));
							}else{
								Painel::alerta('erro','Campos Vazios não são permitidos!');
						}
					}
						
					?>
				<div class="wraper-form">
					
					<form method="post" enctype="multipart/form-data">
						
						<input type="text" name="nome" placeholder="Nome:" value="<?php echo $pdv['nome']; ?>" />
					
						<div class="wraper-text">
							<label>Ativo ?</label>
							<select name="ativo" required >

								<?php
									if ($pdv['ativo'] == 1) {
										echo '<option value="1" selected>Sim</option>';
										echo '<option value="0">Não</option>';
									}elseif($pdv['ativo'] == 0){
										echo '<option value="1">Sim</option>';
										echo '<option value="0" selected>Não</option>';
									}
								?>
							</select>
						</div>
							<input type="hidden" name="id" value="<?php echo $pdv['id']; ?>">
							<input type="hidden" name="nome_tabela" value="tb_fin.pdv">
							<input type="submit" name="atualizar" value="Atualizar" />
					</form>
				</div>
		</section>
	</div>
</body>
</html>
