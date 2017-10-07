<?php
	$entradas = Financeiro::somaEntradas();
	$saidas = Financeiro::somaSaidas();
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
			<p><?php echo ($entradas - $saidas) ?></p>
		</div><!-- box-metrica-single -->
	</div><!-- box-metrica -->

</div>
