
<body>
		
	<header class="header">
		<nav class="menu">
			<div class="menu__logo" ><img src="<?php echo base_url(); ?>images/logo-color.png"></div>
			<ul class="menu__item" >
				<li class="dropdown__item"><a href="<?php echo base_url(); ?>index.php">INICIO</a></li>
				<li class="dropdown__item" id="pedidos">
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
				<li class="dropdown__item" id="compras">
					<a href="#">COMPRAS</a>
					<ul class="inside__menu" id="compras__inside">
						<li class="inside__item">
							<a href="#">Recibir pedido</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>
						<li class="inside__item">
							<a href="#">Confeccionar OC</a>
						</li>
						<li class="inside__item">
							<a href="#">Imprimir OC</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>
						<li class="inside__item">
							<a href="#">Editar OC</a>
						</li>
					</ul>
				</li>
				<li class="dropdown__item" id="proveedores">
					<a href="#" >PROVEEDORES</a>
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
				<li class="dropdown__item" id="articulos">
					<a href="#">ARTICULOS</a>
					<ul class="inside__menu" id="articulos__inside">
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
			<div class="sesion">
				<form method="POST" action="<?php echo site_url('secure/logout'); ?>">
					<button class="logout" type="submit" name="button_logout"><i class="fa-solid fa-right-to-bracket"></i> Logout</button>
				</form>
			</div>
		</nav>
	</header>