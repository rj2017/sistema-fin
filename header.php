<?php 
include("config.php");

if (isset($_GET['loggout'])) {
	Painel::loggout();
}
Painel::verificarPermissaoPagina(1);

?>

	<div class="menu-aside">
		<div class="menu-aside-wrapper">

			<div class="box-usuario">
				<?php 
					if ($_SESSION['img'] == '') {?>
				<div class="avatar-usuario">
					<i class="fa fa-user"></i>
				</div><!-- avatar-usuario -->
					
				<?php }else{ ?>
				<div class="imagem-usuario">
					<img src="<?php echo INCLUDE_PATH;?>uploads/<?php echo $_SESSION['img'];?>">
				</div><!-- avatar-usuario -->
					<?php } ?>
					
				
				<div class="nome-usuario">
					<p><?php echo $_SESSION['nome'];?></p>
					<P><a href="<?php echo INCLUDE_PATH;?>edit_perfil"><i class="fa fa-user" style="margin-right: 4px;" ></i>Perfil</a></P>
				</div><!-- nome-usuario -->
			</div><!-- box-usuario -->
			
			<div class="item-menu">
				<h2 <?php echo Painel::verificarPermissaoMenu(2); ?> >Administração</h2>

				<a <?php echo Painel::selecionadoMenu('dashboard_admin'); ?><?php echo Painel::verificarPermissaoMenu(2); ?> href="<?php echo INCLUDE_PATH;?>dashboard_admin">Dashboard</a>
				<a <?php echo Painel::selecionadoMenu('cad_usuarios'); ?><?php echo Painel::verificarPermissaoMenu(2); ?> href="<?php echo INCLUDE_PATH;?>cad_usuarios">Cadastrar usuários</a>
				<a <?php echo Painel::selecionadoMenu('editar_usuarios'); ?><?php echo Painel::verificarPermissaoMenu(2); ?> href="editar_usuarios">Editar usuários</a>
				<h2 <?php echo Painel::verificarPermissaoMenu(1); ?> >Financeiro</h2>
				<a <?php echo Painel::selecionadoMenu('dashboard_cliente'); ?><?php echo Painel::verificarPermissaoMenu(1); ?> href="#">Dashboard</a>
				<a <?php echo Painel::selecionadoMenu('entrada'); ?><?php echo Painel::verificarPermissaoMenu(1); ?> href="#">Entradas</a>
				<a <?php echo Painel::selecionadoMenu('saida'); ?><?php echo Painel::verificarPermissaoMenu(1); ?> href="#">Saídas</a>
				<a <?php echo Painel::selecionadoMenu('relatorios'); ?><?php echo Painel::verificarPermissaoMenu(1); ?> href="#">Relatórios</a>
				<a <?php echo Painel::selecionadoMenu('parametros'); ?><?php echo Painel::verificarPermissaoMenu(1); ?> href="#">Parâmetrização</a>
			</div><!-- item-menu -->

		</div><!-- menu-aside-wrapper -->
	</div><!-- menu-aside -->

<header>
		<nav class="menu">

				<div class="menu-btn">
					<i class="fa fa-bars"></i>
				</div>
					
				<a href="home"><img src="<?php echo INCLUDE_PATH;?>images/logo2.png"></a>
					
				<div class="loggout">
						<a href="<?php echo INCLUDE_PATH;?>?loggout"> <i class="fa fa-window-close"></i><span>Sair</span></a>
				</div><!-- loggout -->
				<div class="clear"></div>
		</nav><!-- menu -->
</header>
<div class="clear"></div>
