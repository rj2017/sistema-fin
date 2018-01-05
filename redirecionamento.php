<?php
$dateIni =$_POST['data-inicial'];
		$dateFin = $_POST['data-final'];
		Relatorios::relatorioGeral($dateIni, $dateFin);

  ?>