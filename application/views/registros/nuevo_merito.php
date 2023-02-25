	
<form method="POST" action="<?php echo site_url('registros/nuevo_merito/nuevo'); ?>" id="ingresoMerito">
	<div class="container registros">
		<div class="column">
			<div class="register_title">
				<h3><i class="fa-solid fa-person-chalkboard" style="padding-right:8px;"></i>    REPORTAR MERITO: </h3>
			</div>
			<div class="input-container">
				
			</div>
		</div>
		<div class="column">
			<div class="input-container">
				<i class="fas fa-tasks icon"></i>
				<select class="select-field" id="empleado" name="empleado" required>
					<option selected value=''> Personal... </option>
					<?php
						  	$arrayLength = count($empleados);
							$i = 0;
							while ($i < $arrayLength) {?>
								<option value='<?php echo $empleados[$i]->id;?>'><?php echo $empleados[$i]->nombre." ".$empleados[$i]->apellido;?></option>
						 	<?php
							$i++;
							}
						?>	
				</select>
			</div>
			<div class="input-container">

			</div>

			<div class="input-container">

			</div>
		</div>		
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-trophy icon"></i>
					 
					<select class="select-field" id="politica" name="politica" autofocus required>
						<option selected value=''> Politica... </option>
						<?php
						  	$arrayLength = count($politicas);
							$i = 0;
							while ($i < $arrayLength) {?>
								<option value='<?php echo $politicas[$i]->nombre;?>'><?php echo $politicas[$i]->nombre." :".substr($politicas[$i]->descripcion, 0, 76);?></option>
						 	<?php
							$i++;
							}
							?>	
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
				<i class="fa-solid fa-award icon"></i>
				<textarea class="input-field tex-area"rows="4" cols="100" form="ingresoMerito" id="logro" name="logro" maxlength="1200" placeholder="Logro:"></textarea>
			</div>
			<div class="input-container">
				
			</div>

		</div>
	
		<div class="column">
			<div class="input-container">
				<i class="icon"></i>
				<input type="submit" class="btn btn-register" form="ingresoMerito" style="margin-left: 40px; width: 100px;">
			</div>
			<div class="input-container">
				
			</div>
		</div>
		
	</div>
</form>					

<!-- <script type = 'text/javascript' src = "<?php echo base_url();?>js/registrosJava.js"></script> -->
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuRegistrosJava.js"></script>