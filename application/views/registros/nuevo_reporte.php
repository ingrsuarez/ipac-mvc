	
<form method="POST" action="<?php echo site_url('registros/nuevo_reporte/insertar'); ?>" id="ingresoReporte">
	<div class="container registros">
		<div class="column">
			<div class="register_title">
				<h3><i class="fas fa-tasks"></i> NUEVO REPORTE: </h3>
			</div>
			<div class="input-container">
				
			</div>
		</div>
		<div class="column">
				<div class="input-container">
					<i class="fas fa-text-width icon"></i>
					<input type="text" class="input-field" placeholder="Título:" form="ingresoReporte" id="titulo" name="titulo" maxlength="300" autofocus required>	
				</div>
				<div class="input-container">
					

				</div>
		</div>
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-book icon"></i>
				<select class="select-field" id="proceso" name="proceso" required>

					<option selected value=''> Proceso... </option>
					<?php
					  	$arrayLength = count($procesos);
						$i = 0;
						while ($i < $arrayLength) {?>
							<option value='<?php echo $procesos[$i]->id;?>'><?php echo $procesos[$i]->nombre;?></option>
					 	<?php
						$i++;
						}
						?>	
				</select>

				<i class="fa-solid fa-users icon"></i>
				<select class="select-field" id="involucrado" name="involucrado" required>

					<option selected value=''> Involucrado... </option>
					<?php
					  	$arrayLength = count($empleados);
						$i = 0;
						while ($i < $arrayLength) {?>
							<option value='<?php echo $empleados[$i]->id;?>'><?php echo $empleados[$i]->nombre;?></option>
					 	<?php
						$i++;
						}
						?>	
				</select>
			</div>
			<div class="input-container">
					

			</div>
		</div>
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-object-group icon"></i>
				<select class="select-field" id="tipo" name="tipo" required>
					<option selected value=''> Tipo... </option>
					<option value='FALLA'> FALLA </option>
					<option value='INCIDENTE'> INCIDENTE </option>
					<option value='OPORTUNIDAD'> OPORTUNIDAD DE MEJORA </option>
					<option value='RECLAMO'> RECLAMO </option>
					
				</select>

				<i class="fas fa-tasks icon"></i>
				<select class="select-field" id="sector" name="sector" required>
					<option selected value=''> Sector... </option>
					<?php
						  	$arrayLength = count($sector);
							$i = 0;
							while ($i < $arrayLength) {?>
								<option value='<?php echo $sector[$i]->id;?>'><?php echo $sector[$i]->nombre;?></option>
						 	<?php
							$i++;
							}
						?>	
				</select>
			</div>
			<div class="input-container">
				
			</div>
		</div>
		<div class="column">
			<div class="input-container">
				<i class="far fa-comments icon"></i>
				<textarea class="input-field tex-area"rows="4" cols="100" form="ingresoReporte" id="descripcion" name="descripcion" maxlength="1200" placeholder="Descripción:"></textarea>
			</div>
			<div class="input-container">
				
			</div>

		</div>
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-toolbox icon"></i>
				<textarea class="input-field"rows="4" cols="100" form="ingresoReporte" id="tareas" name="tarea" maxlength="1200" placeholder="Tareas:"></textarea>
			</div>
			<div class="input-container">
				
			</div>

		</div>
		<div class="column">
			<div class="input-container">
				<i class="icon"></i>
				<input type="submit" class="btn btn-register" form="ingresoReporte" style="margin-left: 40px; width: 100px;">
			</div>
			<div class="input-container">
				
			</div>
		</div>
		
	</div>
</form>					

<!-- <script type = 'text/javascript' src = "<?php echo base_url();?>js/registrosJava.js"></script> -->
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuRegistrosJava.js"></script>