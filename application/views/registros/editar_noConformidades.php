	
<form method="POST" action="<?php echo site_url('registros/editar_noConformidad/guardar'); ?>" id="ingresoNoConformidad">
	<div class="container registros">
		<div class="column">
			<div class="register_title">
				<h3><i class="fas fa-tasks"></i>  NUEVA NO CONFORMIDAD: </h3>
			</div>
			<div class="input-container">
				
			</div>
		</div>
		<div class="column">

				<div class="input-container">
					<i class="fas fa-text-width icon"></i>
					<input type="text" class="input-field" placeholder="Título:" form="ingresoNoConformidad" id="titulo" name="titulo" maxlength="300" value="<?php echo $noConformidad[0]->titulo; ?>" readonly required>	
					<input type="hidden" value="<?php echo $noConformidad[0]->id;?>" name="id_noConformidad">
				</div>
				<div class="input-container">
					

				</div>
		</div>
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-book icon"></i>
				<select class="select-field" id="proceso" name="proceso">

					<option selected value='<?php echo $noConformidad[0]->id_proceso; ?>'> <?php echo $noConformidad[0]->proceso; ?> </option>
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
			
				<i class="fa-solid fa-book icon"></i>
				<select class="select-field" id="empleado1" name="empleado1">

					<option selected value='<?php echo $noConformidad[0]->empleado; ?>'> <?php echo $noConformidad[0]->nombre." ".$noConformidad[0]->apellido; ?> </option>
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
				<i class="far fa-address-card icon"></i>
				<select class="select-field" id="tipo" name="tipo">
					<option selected value='<?php echo $noConformidad[0]->tipo;?>'> <?php echo $noConformidad[0]->tipo;?> </option>
					<option value='NO SE SIGUE EL PROCEDIMIENTO'> NO SE SIGUE EL PROCEDIMIENTO </option>
					<option value='ERROR DE INGRESO'> ERROR DE INGRESO </option>
					<option value='TAREAS SIN REALIZAR'> TAREAS SIN REALIZAR </option>
					<option value='NO SE CONOCE EL PROCEDIMIENTO'> NO SE CONOCE EL PROCEDIMIENTO </option>

				</select>

				<i class="fas fa-tasks icon"></i>
				<select class="select-field" id="estado" name="estado" required>
					<option selected value='abierta'> Estado... </option>
					<option value='abierta'> ABIERTA </option>
					<option value='revision'> REVISIÓN </option>
					<option value='cerrada'> CERRADA </option>
				</select>
			</div>
			<div class="input-container">
				
			</div>
		</div>
		<div class="column">
			<div class="input-container">
				<i class="far fa-comments icon"></i>
				<textarea class="input-field tex-area"rows="4" cols="100" id="descripcion" name="descripcion" maxlength="1200" placeholder="Descripción:" readonly><?php echo $noConformidad[0]->descripcion; ?></textarea>
			</div>
			<div class="input-container">
				
			</div>

		</div>
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-toolbox icon"></i>
				<textarea class="input-field"rows="4" cols="100" id="accion_inmediata" name="accion_inmediata" maxlength="1200" placeholder="Acción inmediata:"><?php echo $noConformidad[0]->accionin; ?></textarea>
			</div>
			<div class="input-container">
				
			</div>

		</div>
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-screwdriver-wrench icon"></i>
				<textarea class="input-field"rows="4" cols="100" id="accion_inmediata" name="accion_correctiva" maxlength="1200" placeholder="Acción correctiva:"><?php echo $noConformidad[0]->accionCorrectiva; ?></textarea>
			</div>
			<div class="input-container">
				
			</div>

		</div>
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-magnifying-glass icon"></i>
				<textarea class="input-field"rows="4" cols="100" id="causas" name="causas" maxlength="1200" placeholder="Causas:"><?php echo $noConformidad[0]->causas; ?></textarea>
			</div>
			<div class="input-container">
				
			</div>

		</div>
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-file-circle-check icon"></i>
				<textarea class="input-field"rows="4" cols="100" id="causas" name="eficacia" maxlength="1200" placeholder="Eficacia:"><?php echo $noConformidad[0]->eficacia; ?></textarea>
			</div>
			<div class="input-container">
				
			</div>

		</div>
		<div class="column">
			<div class="input-container">
				<i class="icon"></i>
				<input type="submit" class="btn btn-register" style="margin-left: 40px; width: 100px;" value="Guardar">
			</div>
			<div class="input-container">
				
			</div>
		</div>
		
	</div>
</form>					

<!-- <script type = 'text/javascript' src = "<?php echo base_url();?>js/registrosJava.js"></script> -->
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuRegistrosJava.js"></script>