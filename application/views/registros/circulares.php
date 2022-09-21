	
<form method="POST" action="<?php echo site_url('registros/circulares/nueva'); ?>" id="ingresoCircular">
	<div class="container registros">
		<div class="column">
			<div class="register_title">
				<h3><i class="fas fa-tasks"></i>  NUEVA CIRCULAR: </h3>
			</div>
			<div class="input-container">
				
			</div>
		</div>
		<div class="column">

			
				<div class="input-container">
					<i class="fas fa-text-width icon"></i>
					<input type="text" class="input-field" placeholder="Título:" form="ingresoCircular" id="titulo" name="titulo" maxlength="300" autofocus required>	
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
			</div>
			<div class="input-container">
					

			</div>
		</div>
		<div class="column">
			<div class="input-container">
				<i class="far fa-address-card icon"></i>
				<select class="select-field" id="tipo" name="tipo" required>
					<option selected value=''> Tipo... </option>
					<option value='PRE-ANALITICA'> PRE-ANALITICA </option>
					<option value='ANALITICA'> ANALITICA </option>
					<option value='POS ANALITICA'> POS ANALITICA </option>
					<option value='MEDICA'> MEDICA </option>
					<option value='ADMINISTRATIVA'> ADMINISTRATIVA </option>
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
				<textarea class="input-field tex-area"rows="4" cols="100" form="ingresoCircular" id="descripcion" name="descripcion" maxlength="1200" placeholder="Descripción:"></textarea>
			</div>
			<div class="input-container">
				
			</div>

		</div>
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-toolbox icon"></i>
				<textarea class="input-field"rows="4" cols="100" form="ingresoCircular" id="tareas" name="tareas" maxlength="1200" placeholder="Tareas:"></textarea>
			</div>
			<div class="input-container">
				
			</div>

		</div>
		<div class="column">
			<div class="input-container">
				<i class="icon"></i>
				<input type="submit" class="btn btn-register" form="ingresoCircular" style="margin-left: 40px; width: 100px;">
			</div>
			<div class="input-container">
				
			</div>
		</div>
		
	</div>
</form>					

<!-- <script type = 'text/javascript' src = "<?php echo base_url();?>js/registrosJava.js"></script> -->
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuRegistrosJava.js"></script>