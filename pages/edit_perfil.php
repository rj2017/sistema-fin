<?php
Painel::verificarPermissaoPagina(1);
?>


<div class="box-content">
	<h2><i class="fa fa-pencil"></i>Editar Perfil</h2>
	<div class="wraper-form">
		<form method="post" enctype="multipart/form-data">
			<?php
				if (isset($_POST['acao'])) {
					

					$usuario = new Usuario();

					$nome = $_POST['nome'];
					$senha = $_POST['senha'];
					$img = $_FILES['imagem'];
					$img_atual = $_POST['imagem_atual'];

					if ($img['name'] != '') {
						//existe upload de imagem
						
						if (Painel::imagemValida($img)) {

							Painel::deleteFile($img_atual);
							$img = Painel::uploadFile($img);


								if ($usuario->atualizarUsuarioPerfil($nome,$senha,$img)) {
								//se a atualização der certo

								Painel::alerta('sucesso','Atualizado com sucesso!');
								
								}else{
									//se a atualização não der certo
									Painel::alerta('erro','Ocorreu um erro ao atualizar!');
								}

						}else{
							Painel::alerta('erro','O formato da imagem não é valido!');
						}

					}else{
						//não existeupload de imagem

						$img = $img_atual;
						if ($usuario->atualizarUsuarioPerfil($nome,$senha,$img)) {
							//se a atualização der certo

							Painel::alerta('sucesso','Atualizado com sucesso!');
							
						}else{
							//se a atualização não der certo
							Painel::alerta('erro','Ocorreu um erro ao atualizar!');
						}
					}
				}
			?>

			<input type="text" name="nome" placeholder="Nome Completo" value="<?php echo $_SESSION['nome'];?>" required />
			<input type="password" name="senha" placeholder="senha" value="<?php echo $_SESSION['senha'];?>" required />

			<div class="wraper-text">
				<label>Imagem</label>
				<input type="file" name="imagem" />
				<input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img'];?>">
			</div><!-- form-group -->

			<div class="wraper-text">
				<input type="submit" name="acao" value="Atualizar" />
			</div><!-- wraper-text -->

		</form>
	</div>

</div><!-- box-content -->