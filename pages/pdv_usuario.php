<div class="box-content">
	<h2><i class="fa fa-link"></i>PDV x Usuário</h2>

	<div class="wraper-form">
		<?php
			Financeiro::pdvUsuario();
		?>
	
		<form method="post">

		  <input list="pdvs" name="pdv" placeholder="PDV:" id="input" required>

		  <datalist id="pdvs">
		  	<?php
		  		$option = Usuario::selectAll('tb_fin.pdv');

		  		foreach ($option as $key => $value) {
		  			$id = $value['id'];
		  			$nome = $value['nome'];

		  			echo '<option value="'.$id.' - '.$nome.'">';
		  		}
		  	?>
		  </datalist>

		  <input list="usuarios" name="usuario" placeholder="Usuário:" id="input" required>

		  <datalist id="usuarios">
		    <?php
		  		$option = Usuario::selectAll('tb_admin.usuario');

		  		foreach ($option as $key => $value) {
		  			$id = $value['id'];
		  			$nome = $value['nome'];

		  			echo '<option value="'.$id.' - '.$nome.'">';
		  		}
		  	?>
		  </datalist>

		<div>
		  <input type="submit" name="cadastrar" value="cadastrar" >
		</div>

		</form>

	</div>
</div>