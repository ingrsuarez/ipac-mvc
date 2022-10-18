	
<form method="POST" action="<?php echo site_url('registros/orden_trabajo/nueva'); ?>" id="ingresoOrden">
	<div class="container registros">
		<div class="column">
			<div class="register_title">
				<h3><i class="fas fa-tasks"></i>  NUEVA ORDEN DE TRABAJO: </h3>
			</div>
			<div class="input-container">
				
			</div>
		</div>

		
		<div class="column">
			<div class="input-container">
				<i class="far fa-address-card icon"></i>
				<select class="select-field" id="tipo" name="tipo" required>
					<option selected value=''> Tipo... </option>
					<option value='VERIFICACION'> VERIFICACIÓN </option>
					<option value='CALIBRACION'> CALIBRACIÓN </option>
					<option value='PREVENTIVO'> MANTENIMIENTO PREVENTIVO </option>
					<option value='CORRECTIVO'> MANTENIMIENTO CORRECTIVO </option>
					<option value='ADMINISTRATIVA'> ADMINISTRATIVA </option>
				</select>

				<i class="fas fa-tasks icon"></i>
				<select class="select-field" id="sector" name="sector" required>
					<option selected value=''> Sector... </option>
					<?php
						  	$arrayLength = count($sector);
							$i = 0;
							while ($i < $arrayLength) {?>
								<option value='<?php echo $sector[$i]->id;?>'><?php echo ucfirst($sector[$i]->nombre);?></option>
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
				<i class="fa-solid fa-book icon"></i>
				<select class="select-field" id="activo" name="activo">

					<option selected value=''> Equipo... </option>
					<?php
					  	$arrayLength = count($activos);
						$i = 0;
						while ($i < $arrayLength) {?>
							<option value='<?php echo $activos[$i]->id;?>'><?php echo $activos[$i]->nombre;?></option>
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
				<textarea class="input-field tex-area"rows="4" cols="100" form="ingresoOrden" id="descripcion" name="descripcion" maxlength="1200" placeholder="Descripción:"></textarea>
			</div>
			<div class="input-container">
				
			</div>

		</div>
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-toolbox icon"></i>
				<input type="number" class="input-field"rows="4" cols="100" form="ingresoOrden" id="horas" name="horas" maxlength="1200" placeholder="Horas:">
			</div>
			<div class="input-container">
				
			</div>
			<div class="input-container">
				
			</div>
			<div class="input-container">
				
			</div>
		</div>
		<div class="column">
			<div class="input-container">
				<i class="icon"></i>
				<input type="submit" class="btn btn-register" form="ingresoOrden" style="margin-left: 40px; width: 100px;">
			</div>
			<div class="input-container">
				
			</div>
		</div>
		
	</div>
</form>					

<!-- <script type = 'text/javascript' src = "<?php echo base_url();?>js/registrosJava.js"></script> -->
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuRegistrosJava.js"></script>