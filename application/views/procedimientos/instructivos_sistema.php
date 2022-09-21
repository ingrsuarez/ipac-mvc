
		<!-- <div MAIN IN ASIDE TEMPLATE> -->

			<div class="board board-flow">
				<div class="flow_column">

					<div class="flow_box2">
						<div class="container_title container_title-flow">ADMINISTRACIÓN</div>
						<div class="rows__box">	
							<form action="t" method ='POST'>
								<button type='submit' class='btn btn-flow' name='Verificar'>VENTAS</button>
							</form>
							<form action="t" method ='POST'>
								<button type='submit' class='btn btn-flow' name='Verificar'>COMPRAS</button>
							</form>
							<form action="t" method ='POST'>
								<button type='submit' class='btn btn-flow' name='Verificar'>MANTENIMIENTO</button>
							</form>	
							</form>
							<form action="01/manual de bioseguridad.pdf" method ='POST'>
								<button type='submit' class='btn btn-flow' name='Verificar'>H S E</button>
							</form>
						</div>
					</div>
				</div>
				<div class="flow_column">
					<div class="arrow_down">
						<p></p>
					</div>
					<div class="arrow_down">
						<p></p>
					</div>
					<div class="arrow_down">
						<p></p>
					</div>
				</div>
				<div class="flow_column">	 
					<div class="flow_box">
						<div class="container_title container_title-flow">ADMISIÓN</div>
						<form action="07/manual de recepcion de pacientes.pdf" method ='POST'>
							<button type='submit' class='btn btn-flow' name='Verificar'>INGRESO DE PACIENTES</button>
						</form>
						<form action="09/indicaciones para pacientes.pdf" method ='POST'>
							<button type='submit' class='btn btn-flow' name='indicaciones'>INDICACIONES</button>
						</form>
						<form action="09/extracciones especiales.pdf" method ='POST'>
							<button type='submit' class='btn btn-flow' name='indicaciones'>EXTRACCIONES ESPECIALES</button>
						</form>
						
						<form action="09/indentificacion de muestras.pdf" method ='POST'>
							<button type='submit' class='btn btn-flow' name='indicaciones'>IDENTIFICACIÓN DE MUESTRAS</button>
						</form>
					</div>
					<div class="arrow_right">
						
						<p></p>
					</div>
					<div class="flow_box">
						<div class="container_title container_title-flow">ANÁLISIS</div>
						<form action="09/instructivos de procedimientos en Quimica Clinica.pdf" method ='POST'>
							<input type="hidden" name="vid" value="id">
							<button type='submit' class='btn btn-flow' name='Verificar'>QUÍMICA CLÍNICA</button>
						</form>
						<form action="09/instructivos de procedimientos en Quimica Clinica.pdf" method ='POST'>
							<button type='submit' class='btn btn-flow' name='Verificar'>HEMATOLOGÍA</button>
						</form>
							<button type='submit' class='btn btn-flow' name='Verificar'>HORMONAS</button>

						</form>
						<form action="09/TOMA DE MUESTRAS DE AGUA.pdf" method ='POST'>
							<button type='submit' class='btn btn-flow' name='Verificar'>AGUAS</button>
						</form>
						<form action="09/Instructivo de procedimientos en orinas.pdf" method ='POST'>
							<button type='submit' class='btn btn-flow' name='Verificar'>ORINAS</button>
						</form>
						<form action="09/diagrama de flujo identificacion de Bacterias.pdf" method ='POST'>
							<button type='submit' class='btn btn-flow' name='indicaciones'>IDENTIFICACIÓN DE BACTERIAS</button>
						</form>
					</div>
					<div class="arrow_right">
						
						<p></p>
					</div>
					<div class="flow_box">
						<div class="container_title container_title-flow">POST ANALÍTICA</div>
						<form  method ='POST'>
							<input type="hidden" name="vid" value="id">
							<button type='submit' class='btn btn-flow' name='Verificar'>VALIDACIÓN DE RESULTADOS</button>
							<button type='submit' class='btn btn-flow' name='Verificar'>ENTRGA DE INFORMES</button>
						</form>
					</div>
				</div>	
				<div class="flow_column">
					<div class="flow_box2">
						<div class="container_title container_title-flow">SOPORTE</div>
						<form action="<?php echo base_url(); ?>index.php/procedimientos/calculos/" method ='POST'>
							<button type='submit' class='btn btn-flow' name='Verificar'>CALCULOS</button>
						</form>
					</div>
				</div>
				
			</div>
		</div><!-- <close div MAIN IN ASIDE TEMPLATE> -->
		<script type = 'text/javascript' src = "<?php echo base_url();?>js/codigoJava.js"></script>
