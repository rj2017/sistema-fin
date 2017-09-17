<?php
	Painel::verificarPermissaoPagina(2);
	$usuarios_onlines = Painel::listarUsuariosOnline();
	$usuarios_ativos = Painel::countUsariosAtivos();
?>
<div class="box-content w100">
	<h2><i class="fa fa-home"></i>Dashboard - Painel Administrador</h2>

	<div class="box-metrica">
		<div class="box-metrica-single">
			<h2>Usuários ativos</h2>
			<p><?php echo count($usuarios_ativos); ?></p>
		</div><!-- box-metrica-single -->

		<div class="box-metrica-single">
			<h2>Usuários onlines</h2>
			<p><?php
				echo count($usuarios_onlines);
			?></p>
		</div><!-- box-metrica-single -->

		<div class="box-metrica-single">
			<h2>Comércios ativos</h2>
			<p>0</p>
		</div><!-- box-metrica-single -->
	</div><!-- box-metrica -->

</div>

<div class="box-content w100">
	<h2><i class="fa fa-rocket"></i>Usuários online</h2>

	<div class="table-responsive">
		<div class="row">

			<div class="col">
				<span>IP</span>
			</div><!-- col -->

			<div class="col">
				<span>Última ação</span>
			</div><!-- col -->

		</div><!-- row -->
<?php 
foreach ($usuarios_onlines as $key => $value) {
		
		$ip = $value['ip'];
		$ultima_acao = $value['ultima_acao'];

		echo '<div class="row"><div class="col">';
		echo "<span>$ip</span>";
		echo '</div><div class="col">';
		echo '<span>'.date('d/m/Y H:i:s',strtotime($ultima_acao)).'</span>';
		echo '</div></div>';
}
?>
	</div><!-- table-responsive -->
</div><!-- box-content -->

<div class="clear"></div>

