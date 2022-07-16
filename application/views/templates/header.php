<body>
		
	<header class="header">
		<nav class="menu">
			<div class="menu__logo" ><img src="<?php echo base_url(); ?>images/logo-color.png"></div>
			<ul class="menu__item" >
				<li class="dropdown__item dropdown__item--active" id="home"><a href="<?php echo base_url(); ?>index.php">INICIO</a></li> 
				<li class="dropdown__item" id="compras">
					<a href="#" >COMPRAS</a>
					<ul class="inside__menu" id="compras__inside">
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/compras/pedidos/">Pedidos</a>
						</li>
						<li class="inside__item">
							<a href="#">Recibir compra</a>
						</li>
						<li class="inside__item">
							<a href="#">Articulos</a>
						</li>
					</ul>
				</li>
				<li class="dropdown__item" id="procedimientos">
					<a href="#">PROCEDIMIENTOS</a>
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
				<li class="dropdown__item" id="registros">
					<a href="#" >REGISTROS</a>
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
				<li class="dropdown__item" id="contacto">
					<a href="#">CONTACTO</a>
				</li>
				<div class="dropdown__toggle" id="toggle">
					<i class="fa-solid fa-bars"></i>
				</div>
			</ul>
			
			<div class="sesion">
				<form method="POST" action="<?php echo site_url('secure/logout'); ?>">
					<button class="logout" type="submit" name="button_logout"><i class="fa-solid fa-right-to-bracket"></i> Logout</button>
				</form>
			</div>
		</nav>
	</header>