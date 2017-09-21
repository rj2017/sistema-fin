<?php
Painel::verificarPermissaoPagina(1);
?>


<div class="box-content">
	<h2><i class="fa fa-pencil"></i>Editar Perfil</h2>
	<div class="wraper-form">
		<form method="post" enctype="multipart/form-data">
			<?php
				Usuario::editarPerfil();
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