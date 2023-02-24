	<div class="main">
		<aside>
			<nav class="menu__horiz">
				<ul class="dropdown__menu__horiz">
					<li class="dropdown__horiz__item">
						<span id="horiz1"><a><i class="fas fa-user"></i> <?php echo ($nombre)?></a><i class="fas fa-angle-right" style="padding-left: 10px;" id="flecha1"></i></span>
						
						<ul class="inside__menu__horiz" id="horiz1__inside" style="opacity: 0">
							<li class="inside__item__horiz">
								<a href="<?php echo base_url(); ?>index.php/rrhh/calendario/"><i class="fas fa-business-time"></i> Licencias</a>
							</li>
							<li class="inside__item__horiz">
								<a href="#"><i class="fas fa-user-graduate"></i> Competencias</a>
							</li>
							<li class="inside__item__horiz">
								<a href="<?php echo base_url(); ?>index.php/rrhh/mi_productividad/"><i class="fas fa-tasks" style="padding-right: 10px;"></i>Desempeño</a>
							</li>
						</ul>
					</li>
					<div class="divider"> </div>
					<li class="dropdown__horiz__item">
						<span id="horiz2"><a href="#"><i class="fas fa-user-edit"></i> Cuenta  </a><i class="fas fa-angle-right" style="padding-left: 10px;" id="flecha2"></i></span>
						<ul class="inside__menu__horiz" id="horiz2__inside" style="opacity: 0">
							<li class="inside__item__horiz">
								<a href="<?php echo base_url(); ?>index.php/rrhh/modificar_clave/"><i class="fas fa-unlock" style="padding-right: 10px;"></i> Modificar contraseña</a>
							</li>
							<li class="inside__item__horiz">
								<a href="#"><i class="fas fa-id-card" style="padding-right: 10px;"	></i> Datos personales</a>
							</li>
						</ul>
					</li>
					<div class="divider"> </div>
					<li class="dropdown__horiz__item">
						<span id="horiz3"><a href="#"><i class="fas fa-external-link"></i> Accesos  </a><i class="fas fa-angle-right" style="padding-left: 10px;" id="flecha3"></i></span>
						<ul class="inside__menu__horiz" id="horiz3__inside" style="opacity: 0">
							<li class="inside__item__horiz">
								<a href="http://www.colbionqn.com.ar/" target="_blank"><i class="fas fa-laptop-medical" style="padding-right: 10px;"></i> Colegio de bioquímicos</a>
							</li>
							<li class="inside__item__horiz">
								<a href="https://cbn.suap.com.ar/prestador.php/orden" target="_blank"><i class="fas fa-exchange-alt" style="padding-right: 10px;"></i> SUAP Laboratorio</a>
							</li>
							<li class="inside__item__horiz">
								<a href="https://menu.traditum.com/View/Login.aspx" target="_blank"><i class="fas fa-link" style="padding-right: 10px;"></i> Medife</a>
							</li>
							<li class="inside__item__horiz">
								<a href="https://www.experta.com.ar/art/que-hacer-en-caso-de-accidente/"><i class="fas fa-ambulance" style="padding-right: 10px;" target="_blank"></i> ART</a>
							</li>
						</ul>
					</li>

				</ul>
					
					<button class="btn btn-note" type="button" id="btn_general">Agregar Nota</button>
					<button class="btn btn-note fade" type="button" id="btn_ordenes">Agregar Nota</button>
					<button class="btn btn-note fade" type="button" id="btn_analitica">Agregar Nota</button>
				<!-- </form> -->
			</nav>
		</aside>