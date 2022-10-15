	

	<div class="container registros" >
		
		<?php echo $error;?>

		<?php echo form_open_multipart('registros/do_upload');?>
		<div class="column">
			<div class="register_title">
				<h3><i class="fas fa-tasks"></i>  NUEVO DOCUMENTO: </h3>
			</div>
			<div class="input-container">
				
			</div>
		</div>
		<div class="column">

			
				<div class="input-container">
					<i class="fas fa-text-width icon"></i>
					<input type="text" class="input-field" placeholder="Nombre:" id="titulo" name="nombre" maxlength="300" autofocus required>	
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
							<option value='<?php echo "0".$procesos[$i]->id;?>'><?php echo $procesos[$i]->nombre;?></option>
					 	<?php
						$i++;
						}
						?>	
				</select>
				<i class="fas fa-text-width icon"></i>
				<input type="text" class="input-field" placeholder="Revisión:" id="titulo" name="revision" maxlength="300">

			</div>
			<div class="input-container">

			</div>
		</div>
		<div class="column">
			<div class="input-container">
				<i class="far fa-address-card icon"></i>
				<select class="select-field" id="tipo" name="tipo" required>
					<option selected value=''> Tipo... </option>
					<option value='REGISTRO'> REGISTRO </option>
					<option value='MANUAL'> MANUAL </option>
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
				<i class="fa-regular fa-calendar icon"></i>
				<input type="text" class="input-field" id="fecharev" placeholder="Fecha revisión" name="fecharev" onfocus="(this.type='date')" onblur="(this.type='text')">
				<i class="fa-regular fa-calendar icon"></i>
				<input type="text" class="input-field" id="vencimiento" name="vencimiento" placeholder="Vencimiento" name="vencimiento" onfocus="(this.type='date')" onblur="(this.type='text')">
			</div>
			<div class="input-container">
				
			</div>
		</div>
		
		<div class="column">
			<div class="input-container">		

				<input type="file" class="input-field" name="userfile" />

				<br /><br />

				<input type="submit" class="btn btn-register" value="Subir documento" />

				
			</div>
			<div class="input-container">
				
			</div>
		</div>
		</form>	
	</div>
				

<!-- <script type = 'text/javascript' src = "<?php echo base_url();?>js/registrosJava.js"></script> -->
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuRegistrosJava.js"></script>