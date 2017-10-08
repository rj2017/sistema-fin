<div class="box-content">
	<h2><i class="fa fa-link"></i>PDV x Usuário<div class="btn-pesq"><i class="fa fa-search"></i></div></h2>

	<div class="wraper-form">
		<?php
			Usuario::pdvUsuario();
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
		  		$option = Usuario::selectAll('tb_admin.Usuario');

		  		foreach ($option as $key => $value) {
		  			$id = $value['id'];
		  			$nome = $value['nome'];

		  			echo '<option value="'.$id.' - '.$nome.'">';
		  		}
		  	?>
		  </datalist>

		  <input type="submit" name="cadastrar" value="cadastrar" />

		</form>

	</div>
</div>