<body>
		
	<header class="header">
		<nav class="menu">
			<div class="menu__logo" ><img src="<?php echo base_url(); ?>images/logo-color.png"></div>
			<ul class="menu__item" >
				<li class="dropdown__item" id="home"><a href="<?php echo base_url(); ?>index.php">INICIO</a></li> 
				<li class="dropdown__item" id="compras">
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
				<li class="dropdown__item  dropdown__item--active" id="registros">
					<a href="<?php echo base_url(); ?>index.php/registros/circulares/" >REGISTROS</a>
					
				</li>
				<li class="dropdown__item" id="contacto">
					<a href="<?php echo base_url(); ?>index.php/rrhh/panel/">RRHH</a>
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
			<div class="menu__logo2" ><a href="#"><i class="fa-solid fa-book"></i></i></a></div>
			<ul class="menu__item" >
				
				<li class="dropdown__item2" id="circulares">
					<a href="#" >CIRCULARES</a>
					<ul class="inside__menu" id="circulares__inside">
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/circulares/">Nueva circular</a>
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/circulares_activas/">Circulares activas</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/editar_circulares/">Editar circulares</a>
						</li>
					</ul>
				</li>
				<li class="dropdown__item2" id="capacitaciones">
					<a href="#" >REPORTES</a>
					<ul class="inside__menu" id="capacitaciones__inside">
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/nuevo_reporte/">Nuevo Reporte</a>
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/listado_reportes/">Listado de Reportes</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/nuevo_merito/">Reportar Mérito</a>
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/listado_meritos/">Listado de Méritos</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>
						
						<li class="inside__item">
							<a href="#"></a>
						</li>
					</ul>
				</li>
				<li class="dropdown__item2" id="orden_trabajo">
					<a href="#">ORDEN DE TRABAJO</a>
					<ul class="inside__menu" id="orden_trabajo__inside">
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/orden_trabajo/">Nueva Orden</a>
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/listado_ordenes/">Listado de Ordenes</a>
						</li>
						<li class="inside__item">
							<a href="#">Cerrar Orden</a>
						</li>
					</ul>
				</li>
				<li class="dropdown__item2" id="no_conformidades">
					<a href="#">NO CONFORMIDADES</a>
					<ul class="inside__menu" id="no_conformidades__inside">
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/mis_noConformidades/">Mis No conformidades</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/no_conformidades/">Nueva No Conformidad</a>
						</li>

						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/listado_noConformidades/">Listado NC</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/ingresar_auditoria/">Nueva Auditoría</a>
						</li>
					</ul>
				</li>
				
				<li class="dropdown__item2" id="documentos">
					<a href="#">DOCUMENTOS</a>
					<ul class="inside__menu" id="documentos__inside">
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/insertar_documento/">Subir documento</a>
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/listado_documentos/">Listado de documentos</a>
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