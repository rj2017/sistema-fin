<?php
Painel::verificarPermissaoPagina(1);
/* variaveis de preenchimento*/
$find = '';
$descricao = '';
$id_tipo = '';
$tipo = '';
$id_subTipo = '';
$subTipo = '';
$valor = '';
/***********/

if (isset($_POST['buscar'])) {
	$cod = $_POST['cod'];

	$busca = Financeiro::selectItem($cod);



	foreach ($busca as $key => $value) {

		$descricao = $value['descricao'];
		$id_tipo = $value['id_parametro'];
		$tipo = $value['parametro'];
		$id_subTipo = $value['id_sub-parametro'];
		$subTipo = $value['sub-parametro'];
		$valor = $value['valor'];
	}
	if ($descricao == '') {
	Painel::alerta("erro", "não localizamos o código informado");
	}


	$find = $cod;
	
	}

?>

	<div class="box-content">
		<h2><i class="fa fa-minud"></i>Saídas</h2>
		<div class="wrap-cod">
			<form method="post">
			
					<input type="number" name="cod" placeholder="Código" value="<?php echo $find ?>">
					<input type="submit" class="item-cod" name="buscar" value="buscar" />
			
			</form>
		</div>
		<div class="clear"></div>
	</div>


	<div class="box-content">
		

		<section class="cadastrar">
					<?php
						Financeiro::saida();
					
					?>
				<div class="wraper-form">
					
					<form method="post">

						<input style="display: none;" type="text" name="cod" value="<?php echo $find ?>" />
						
						<input type="text" name="descricao" required placeholder="Descrição:" readonly="true" value="<?php echo $descricao ?>" />

						<div class="wraper-text">
							<label>Tipo</label>
							<select name="tipo" id="tipo" required >
								<option value="<?php echo $id_tipo ?>"><?php echo $tipo ?></option>

								
							</select>
						</div>
						<div class="wraper-text">
							<label class="carregando">Sub-Tipo </label><span style="display: none;">Aguarde carregando...</span>

							<select name="sub-tipo" id="sub-tipo" required >
								<option value="<?php echo $id_subTipo ?>"><?php echo $subTipo ?></option>
							</select>
						</div>

						
						
						<input type="date" name="data" required placeholder="Data:"  value="<?php echo date ("Y-m-d"); ?>"  />

						<div class="wraper-text" >
							<label>Quantidade:</label>
							<input id="quantidade" type="number" name="quantidade" value="1" required />
						</div>

						<input type="text" name="desconto"  placeholder="Desconto:" id="money" class="desconto"  value="0" required/>

						
						<input type="text" id="valor" name="valor" required placeholder="Valor:" value="<?php if($valor > 0){ ?><?php echo number_format($valor, 2, '.', '.');  } ?>" readonly="true" />

						<input type="text" name="total" ng-app="" required placeholder="Total:" id="money" readonly="true"  class="total" />

						

							<div class="wraper-form">
								<input type="submit" name="enviar" value="Enviar" />
							</div>

					</form>
	
					
				</div>
		</section>
</div>

