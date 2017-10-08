<?php
	$entradas = Financeiro::somaEntradas();
	$saidas = Financeiro::somaSaidas();
	$saldo = $entradas -$saidas;

	@$p_entrada = (($entradas * 100)/($entradas+$saidas));
	@$p_saidas = (($saidas * 100)/($entradas+$saidas));
	@$p_saldo =  (($saldo * 100)/($entradas+$saidas));
?>
<div class="box-content w100">
	<h2><i class="fa fa-home"></i>Dashboard - Painel Financeiro (<?php
	 echo $nome = Financeiro::buscarPdv($_SESSION['pdv']); ?>)</h2>

	<div class="box-metrica">
		<div class="box-metrica-single">
			<h2>Entradas</h2>
			<p><?php  echo 'R$ '.$entradas; ?></p>
		</div><!-- box-metrica-single -->

		<div class="box-metrica-single">
			<h2>Saídas</h2>
			<p><p><?php  echo 'R$ '.$saidas; ?></p></p>
		</div><!-- box-metrica-single -->

		<div class="box-metrica-single">
			<h2>Saldo</h2>
			<p><?php echo $saldo ?></p>
		</div><!-- box-metrica-single -->
	</div><!-- box-metrica -->

</div>


<div class="box-content w100">
	<div class="grafico">
		<h2><i class="fa fa-line-chart"></i>Gráfico de comparação</h2>

		<div class="dados-grafico">
			<div class="wrapper-grafico">
				<p><?php echo number_format($p_entrada, 2).'%'; ?></p>
				<div class="barra-grafico"><div class="res-entrada" style="height:  <?php  echo $p_entrada.'%'; ?>"></div></div>
				<p>Entradas</p>
			</div>

			<div class="wrapper-grafico">
				<p><?php echo number_format($p_saidas, 2).'%'; ?></p>
				<div class="barra-grafico"><div class="res-saida" style="height:  <?php  echo $p_saidas.'%'; ?>"></div></div>
				<p>Saídas</p>
			</div>

			<div class="wrapper-grafico">
				<p><?php echo number_format($p_saldo, 2).'%'; ?></p>
				<div class="barra-grafico"><div class="res-saldo" style="height:  <?php  echo $p_saldo.'%'; ?>"></div></div>
				<p>Saldo</p>
			</div>
		</div>

	</div>
	<div class="clear"></div>
</div>