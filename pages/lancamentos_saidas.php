<?php
	Painel::verificarPermissaoPagina(1);
	$dateIni = date("Y-m-d");
	$dateFin = date("Y-m-d");

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 10;

	if (isset($_POST['pesquisar'])) {


		$dateIni =$_POST['data-inicial'];
		$dateFin = $_POST['data-final'];
		$lancamentos = Financeiro::pesquisarSaidas(($paginaAtual -1) * $porPagina,$porPagina);

	}else {
			$lancamentos = Usuario::selectAll('tb_fin.saidas',($paginaAtual -1) * $porPagina,$porPagina);
	}

	if (isset($_GET['excluir'])) {
				
				$idExcluir = (int)$_GET['excluir'];

				Painel::delete('tb_fin.saidas', $idExcluir);
				Painel::redirect(INCLUDE_PATH.'lancamentos_saidas');

	}

	

	

	
?>
<div class="box-content">
	<h2><a href="lancamentos"><i class="fa fa-arrow-circle-left left"></i></a><i class="fa fa-pencil"></i>Lançamentos - Saídas<div class="btn-pesq"><i class="fa fa-search"></i></div></h2>
	
	<div class="clear"></div>
	<div class="pesquisar-item" >
			<div class="wraper-form">
				<form method="post">
					<input type="text" name="nome" placeholder="Nome: "/>
					<div class="wraper-data">
						<input type="date" name="data-inicial" value="<?php echo $dateIni; ?>">
						<h2>à</h2>
						<input type="date" name="data-final" value="<?php echo $dateFin; ?>">
					</div>
	

				<input type="submit" name="pesquisar" value="Pesquisar" />
				</form>
			</div>
		</div><!-- pesquisar-usuario -->
</div>

<div class="box-content">
		<div class="wraper-table">
				<table>
					<tr>

						<th>Nome</th>
						<th>Data</th>
						<th>Valor</th>
						<th>Deletar</th>

					</tr>
					
					<?php
						foreach (@$lancamentos as $key => $value) {
							$id = $value['id'];
							$nome = $value['descricao'];
							$data = $value['data'];
							$valor = $value['valor'];

							echo "<tr>";
								echo '<td>'.$nome.'</td>';
								echo '<td>'.$data.'</td>';
								echo '<td> R$ '.$valor.'</td>';
								echo '<td><a activeBtn= "delete" href="'.INCLUDE_PATH.'lancamentos_saidas?excluir='.$id.'"><i class="fa fa-times"></i></a></td>';
							echo "</tr>";


							
						}
					  ?>
				</table>
		</div><!-- wraper-table -->

		<div class="paginacao">
			<?php
				$totalPagina = ceil(count(Usuario::selectAll('tb_fin.saidas')) / $porPagina); //ceil: função em PHP que arredonda os numeros para um numero maior

				for ($i=1; $i <= $totalPagina; $i++) { 
					if ($i == $paginaAtual)
						echo '<a href="'.INCLUDE_PATH.'lancamentos_saidas?pagina='.$i.'" class="pagina-active" >'.$i.'</a>';
					else
					echo '<a href="'.INCLUDE_PATH.'lancamentos_saidas?pagina='.$i.'" >'.$i.'</a>';
				}
			?>
		</div><!-- paginacao -->

</div>