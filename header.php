<?php include("config.php");

if (isset($_GET['loggout'])) {
	Painel::loggout();
}

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
				</div><!-- nome-usuario -->
			</div><!-- box-usuario -->
			
			<div class="item-menu">
				<h2>Administração</h2>
				<a href="home">Dashboard</a>
				<a href="cad_usuarios">Cadastrar usuário</a>
				<a href="">Editar usuário</a>
				<h2>Financeiro</h2>
				<a href="">Entradas</a>
				<a href="">Saídas</a>
			</div><!-- item-menu -->

		</div><!-- menu-aside-wrapper -->
	</div><!-- menu-aside -->

<header>
		<nav class="menu">

				<div class="menu-btn">
					<i class="fa fa-bars"></i>
				</div>
					
				<img src="<?php echo INCLUDE_PATH;?>images/logo2.png">
					
				<div class="loggout">
						<a href="<?php echo INCLUDE_PATH;?>?loggout"> <i class="fa fa-window-close"></i><span>Sair</span></a>
				</div><!-- loggout -->
				<div class="clear"></div>
		</nav><!-- menu -->
</header>
<div class="clear"></div>
<script src="<?php echo INCLUDE_PATH;?>js/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH;?>js/home.js"></script>