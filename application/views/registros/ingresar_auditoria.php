	
<form method="POST" action="<?php echo site_url('registros/ingresar_auditoria'); ?>" id="ingresoAuditoria">
	<div class="container registros">
		<div class="column">
			<div class="register_title">
				<h3><i class="fas fa-tasks"></i>  NUEVA AUDITORÍA: </h3>
			</div>
			<div class="register_title">
				<h3><i class="fas fa-tasks"></i>  PROCESOS AUDITADOS: </h3>
			</div>
		</div>
		<div class="column">		
			<div class="input-container">
				<i class="fas fa-text-width icon"></i>
				<input type="text" class="input-field" placeholder="Título:" form="ingresoAuditoria" id="titulo" name="titulo" maxlength="300" autofocus required>	
			</div>
			<div class="input-container"  style="background: #fff;">
				<i class="icon"></i>
				<input type="submit" class="btn btn-register" id="agregarProceso" value="Agregar" style="margin-left: 40px; width: 100px;">
			</div>
		</div>
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-user icon"></i>
				<select class="select-field" id="proceso" name="proceso" required>
					<option selected value=''>Proceso... </option>
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
			<div class="input-container" id="newLine">
					

			</div>
		</div>
		<div class="column">
			<div class="input-container">
				<i class="far fa-address-card icon"></i>
				<select class="select-field" id="empleado" name="empleado">
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

				<div class="col-md-4">
						
						
					</div>
			</div>
			<div class="input-container">
				
			</div>
		</div>
		<div class="column">
			<div class="input-container">
				<i class="far fa-comments icon"></i>
				<textarea class="input-field tex-area"rows="4" cols="100" form="ingresoAuditoria" id="descripcion" name="descripcion" maxlength="1200" placeholder="Descripción:"></textarea>
			</div>
			<div class="input-container">
				
			</div>

		</div>
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-toolbox icon"></i>
				<textarea class="input-field"rows="4" cols="100" form="ingresoAuditoria" id="tareas" name="tareas" maxlength="1200" placeholder="Tareas:"></textarea>
			</div>
			<div class="input-container">
				
			</div>

		</div>
		<div class="column">
			<div class="input-container">
				<i class="icon"></i>
				<input type="submit" class="btn btn-register" form="ingresoAuditoria" style="margin-left: 40px; width: 100px;">
			</div>
			<div class="input-container">
				
			</div>
		</div>
		
	</div>
</form>					



<script type="text/javascript">
					
				const agregar = document.getElementById("agregarProceso");

				agregar.addEventListener("click", function(){

					const newLine = document.getElementById("newLine");
					const proceso = document.createElement('input');
					const textnode = document.createTextNode("Water");
					proceso.appendChild(textnode);
					newLine.appendChild(proceso);

					

				});	

						

						
							
							// var e = document.getElementById("tipo");
							
							// var tipo = e.value;	
							
							

								
								
							// 	var cont = 0;
								
							// 	var json = JSON.parse(result);
								
								
								
							// 	json.forEach(function(value,label){
							// 		cont++;
							// 		$("#tpendientes>tbody").append("<tr class='pedidosT__row'><th scope='row'><div class='custom-control custom-checkbox'><input type='checkbox' class='custom-control-input' id='select"+cont+"' name='select' value='"+json[label].id+"'></div></th>"+
							// 			"<td style='max-width: 100px;'>"+ json[label].fecha+"</td>"+
							// 			"<td style='max-width: 100px;'>"+ json[label].ultimaAct+"</td>"+
							// 			"<td style='max-width: 180px;'>"+ json[label].titulo+"</td>"+
							// 			"<td style='max-width: 110px;'>"+ json[label].tipo+"</td>"+
							// 			"<td style='max-width: 100px;'>"+ json[label].nombre+" "+json[label].apellido+"</td>"+
							// 			"<td style='max-width: 300px;'>"+ json[label].descripcion+"</td>"+
							// 			"<td>"+ json[label].estado+"</td></tr>");
							// 		$('#select'+cont).change(function() {
							// 	        if ($(this).is(':checked')) {
							// 	            $('input[type="checkbox"]').prop("checked", false); //uncheck all checkboxes
  					// 						$(this).prop("checked", true);  //check the clicked one
							// 	        };
					  //   			});
							// 	});
							
						

					
				</script> 
<!-- <script type = 'text/javascript' src = "<?php echo base_url();?>js/registrosJava.js"></script> -->
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuRegistrosJava.js"></script>