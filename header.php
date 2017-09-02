<?php include("config.php");  ?>
<header>
		<nav class="menu">
			<a realtime="home" href="<?php echo INCLUDE_PATH;?>home"><img src="images/logo2.png"></a>
			<div class="dropdown">
				<span>Administrador</span>
				<div class="dropdown-content">
					<a realtime="cad_usuarios" href="cad_usuarios">Usuários</a>
					<a realtime="cad_grupo_usuario" href="cad_grupo_usuario">Grupos de usuários</a>
				</div>
			</div>
			<div class="dropdown">
				<span>Financeiro</span>
				<div class="dropdown-content">
					<a href="">Entradas</a>
					<a href="">Saídas</a>
					<a href="">Relatórios</a>
					<a href="">Parâmetros</a>
				</div>
			</div>
			<div class="perfil"></div>
			<div class="perfil-single">
				<a href="">Perfil</a>
				<a href="">Contato</a>
				<a href="login">Sair</a>
			</div>
		</nav>
		<div class="clear"></div>
	</header>