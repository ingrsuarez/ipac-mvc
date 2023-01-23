	
<form method="POST" action="<?php echo site_url('rrhh/modificar_clave/modificar'); ?>" id="modificarClave">
	<div class="container registros">
		<div class="column">
			<div class="register_title">
				<h3><i class="fas fa-tasks"></i>  MODIFICAR CLAVE: </h3>
			</div>
			<div class="input-container">
				
			</div>
		</div>
		<div class="column">

			
				<div class="input-container">
					<i class="fas fa-text-width icon"></i>
					<input type="password" class="input-field" placeholder="Clave actual:" form="modificarClave" id="clave" name="clave" maxlength="300" autofocus required>	
				</div>
				<div class="input-container">
					

				</div>
		</div>

		<div class="column">
			<div class="input-container">
				<i class="fas fa-text-width icon"></i>
				<input type="password" class="input-field" placeholder="Nueva Clave:" form="modificarClave" id="nuevaClave" name="nuevaClave" maxlength="300" required>	
			</div>
			<div class="input-container">
				

			</div>
		</div>

		<div class="column">
			<div class="input-container">
				<i class="fas fa-text-width icon"></i>
				<input type="password" class="input-field" placeholder="Repita la clave:" form="modificarClave" id="claveRepetida" name="claveRepetida" maxlength="300" required>	
			</div>
			<div class="input-container">
				

			</div>
		</div>

		<div class="column">
			<div class="input-container">
				<i class="icon"></i>
				<input type="submit" class="btn btn-register" form="modificarClave" style="margin-left: 40px; width: 100px;" value="Modificar">
			</div>
			<div class="input-container">
				
			</div>
		</div>
		
	</div>
</form>					

<!-- <script type = 'text/javascript' src = "<?php echo base_url();?>js/registrosJava.js"></script> -->
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuRegistrosJava.js"></script>