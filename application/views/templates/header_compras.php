 
<body>
		
	<header class="header">
		<nav class="menu">
			<div class="menu__logo" ><img src="<?php echo base_url(); ?>images/logo-color.png"></div>
			<ul class="menu__item" >
				<li class="dropdown__item" id="home"><a href="<?php echo base_url(); ?>index.php">INICIO</a></li> 
				<li class="dropdown__item dropdown__item--active" id="active">
					<a href="<?php echo base_url(); ?>index.php/compras/pedidos/" >COMPRAS</a>
				</li>
				<li class="dropdown__item" id="procedimientos">
					<a href="<?php echo base_url(); ?>index.php/procedimientos/instructivos/">PROCEDIMIENTOS</a>
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
					<a href="<?php echo base_url(); ?>index.php/registros/circulares/" >REGISTROS</a>
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
		<nav class="menu_compras">
			<div class="menu__logo2" ><a href="#"><i class="fa-solid fa-cart-shopping"></i></a></div>
			<ul class="menu__item" >
				
				<li class="dropdown__item2" id="pedidos">
					<a href="#" >PEDIDOS</a>
					<ul class="inside__menu" id="pedidos__inside">
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/compras/pedidos/">Pedidos</a>
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/compras/mis_pedidos/">Mis pedidos</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/compras/editar_pedidos/">Editar pedido</a>
						</li>
						<li class="inside__item">
							<a href="#">Compra directa</a>
						</li>
					</ul>
				</li>
				<li class="dropdown__item2" id="compras">
					<a href="#">COMPRAS</a>
					<ul class="inside__menu" id="compras__inside">
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/compras/recibirOC/">Recibir pedido</a>
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/compras/remitos/">Remitos</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/compras/confeccionarOC/">Confeccionar OC</a>
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/compras/imprimirOC/">Imprimir OC</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/compras/editarOC/">Editar OC</a>
						</li>
					</ul>
				</li>
				<li class="dropdown__item2" id="articulos">
					<a href="#" >ARTICULOS</a>
					<ul class="inside__menu" id="articulos__inside">
						<li class="inside__item">
							<a href="#">Buscar Articulo</a>
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/compras/ingresarArticulo">Ingresar Articulo</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/compras/descargarArticulo">Descargar Articulo</a>
						</li>
					</ul>
				</li>
				<li class="dropdown__item2" id="proveedores">
					<a href="#">PROVEEDORES</a>
					<ul class="inside__menu" id="proveedores__inside">
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
				<div class="dropdown__toggle" id="toggle">
					<i class="fa-solid fa-bars"></i>
				</div>
			</ul>
			<div class="menu__logo" ></div>
		</nav>
	</header>