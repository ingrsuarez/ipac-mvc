<body>
		
	<header class="header">
		<nav class="menu">
			<div class="menu__logo" ><img src="<?php echo base_url(); ?>images/logo-color.png"></div>
			<ul class="menu__item" >
				<li class="dropdown__item"><a href="<?php echo base_url(); ?>index.php">INICIO</a></li>
				<li class="dropdown__item dropdown__item--active" id="home">
					<a href="#" >PEDIDOS</a>
					<ul class="inside__menu" id="home__inside">
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/compras/pedidos/">Pedidos</a>
						</li>
						<li class="inside__item">
							<a href="#">Mis pedidos</a>
						</li>
						<li class="inside__item">
							<a href="#">Editar pedido</a>
						</li>
						<li class="inside__item">
							<a href="#">Compra directa</a>
						</li>
					</ul>
				</li>
				<li class="dropdown__item" id="compras">
					<a href="#">COMPRAS</a>
					<ul class="inside__menu" id="procedimientos__inside">
						<li class="inside__item">
							<a href="#">Pre-analítica</a>
						</li>
						<li class="inside__item">
							<a href="#">Analítica</a>
						</li>
						<li class="inside__item">
							<a href="#">Sistema</a>
						</li>
					</ul>
				</li>
				<li class="dropdown__item" id="proveedores">
					<a href="#" >PROVEEDORES</a>
					<ul class="inside__menu" id="servicios__inside">
						<li class="inside__item">
							<a href="#">Servicio 1</a>
						</li>
						<li class="inside__item">
							<a href="#">Servicio 2</a>
						</li>
						<li class="inside__item">
							<a href="#">Servicio 3</a>
						</li>
					</ul>
				</li>
				<li class="dropdown__item" id="articulos">
					<a href="#">ARTICULOS</a>
				</li>
			</ul>
			<div class="sesion">
				<form method="POST" action="<?php echo site_url('secure/logout'); ?>">
					<button class="logout" type="submit" name="button_logout"><i class="fa-solid fa-right-to-bracket"></i> Logout</button>
				</form>
			</div>
		</nav>
	</header>