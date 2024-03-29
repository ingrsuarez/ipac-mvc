
	<div class="container">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i> LISTADO NO CONFORMIDADES: </h3>
		</div>
		<form method="POST" id = "print" action="<?php echo site_url('registros/pdf_noConformidad'); ?>"></form>
		<form method="POST" id = "edit" action="<?php echo site_url('registros/editar_noConformidad'); ?>">
			<div class="container_insert">	  
				<div class="container__form">
					<div class="col-md-4">
						<label for="iestado">Tipo:</label>
						<select class="form-control" id="tipo" name="tipo" >
							<option value="">Seleccione tipo......</option>
							<option value='NO SE SIGUE EL PROCEDIMIENTO'> NO SE SIGUE EL PROCEDIMIENTO </option>
							<option value='ERROR DE INGRESO'> ERROR DE INGRESO </option>
							<option value='TAREAS SIN REALIZAR'> TAREAS SIN REALIZAR </option>
							<option value='NO SE CONOCE EL PROCEDIMIENTO'> NO SE CONOCE EL PROCEDIMIENTO </option>
						</select>  
					</div>
					<div class="col-md-4">
						<label for="iestado">Personal:</label>
						<select class="form-control" id="empleado" name="empleado" autofocus>
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
					<div class="col-md-4">
						<label for="iestado">Tipo:</label>
						<select class="form-control" id="estado" name="estado" >
							<option value="">Seleccione estado......</option>
							<option value='cerrada'> CERRADA </option>
							<option value='abierta'> ABIERTA </option>
							<option value='revision'> EN REVISIÓN </option>
						</select>  
					</div>
					<div class="container__button">
						
						<button type="submit" class="btn btn-insert" name="action" value="edit" form = "edit">Editar</button>
						<button type="submit" class="btn btn-insert" name="action" value="print" form = "print">Imprimir</button>
					</div>
				</div>				
			
			</div>		

				<table class='pedidosT' id="tpendientes">
					
					<thead>
						<tr class="pedidosT__encabezado">
							<th scope='col'>#</th>
							<th scope='col' style="min-width: 100px;">Fecha</th>
							<th scope="col"> Última Actualización</th>
							<th scope='col'>Título</th>
							<th scope='col'>Tipo</th>
							<th scope='col'>Auditado</th>
							<th scope='col'>Descripción</th>
							<th scope="col">Estado </th>
						</tr>
					</thead>
				  	<tbody>
					</tbody>	
				</table>

				<script type="text/javascript">


								function getIndex(row)
								{
									var idNoconformidad = $(row).closest('tr').find("input").val();
									console.log($(row).closest('tr').find("input").val());
									window.location.assign("imprimir?documentId="+idNoconformidad);
								}
					$(document).ready(function(){


						$("#tipo").change(function(){
							
							var e = document.getElementById("tipo");
							
							var tipo = e.value;	
							
							$("#tpendientes>tbody").empty();

							$.post("listado",{tipo: tipo, },function(result){	
								
								var cont = 0;
								
								var json = JSON.parse(result);
								

								
								
								json.forEach(function(value,label){
									cont++;
									
									$("#tpendientes>tbody").append("<tr class='pedidosT__row' onclick='getIndex(this)'><th scope='row'><div class='custom-control custom-checkbox'><input type='checkbox' class='custom-control-input' id='select"+cont+"' name='select' value='"+json[label].id+"'></div></th>"+
										"<td style='max-width: 100px;'>"+ json[label].fecha+
										"<input type='hidden' name='idnoConformidad'"+
										"value='"+json[label].id+"'></td>"+
										"<td style='max-width: 100px;'>"+ json[label].ultimaAct+"</td>"+
										"<td style='max-width: 180px;'>"+ json[label].titulo+"</td>"+
										"<td style='max-width: 110px;'>"+ json[label].tipo+"</td>"+
										"<td style='max-width: 100px;'>"+ json[label].auditado+"</td>"+
										"<td style='max-width: 300px;'>"+ json[label].descripcion+"</td>"+
										"<td>"+ json[label].estado+"</td></tr>");
									$('#select'+cont).change(function() {
								        if ($(this).is(':checked')) {
								            $('input[type="checkbox"]').prop("checked", false); //uncheck all checkboxes
  											$(this).prop("checked", true);  //check the clicked one
								        };
					    			});
								});
							});
						});


						$("#empleado").change(function(){
							
							var e = document.getElementById("empleado");
							
							var empleado = e.value;	
							
							$("#tpendientes>tbody").empty();
							
							$.post("listado_empleado",{userId: empleado, },function(result){	
								
								var cont = 0;
								
								var json = JSON.parse(result);
								
								
								
								json.forEach(function(value,label){
									cont++;
									console.log(json[label])
									$("#tpendientes>tbody").append("<tr class='pedidosT__row' onclick='getIndex(this)'><th scope='row'><div class='custom-control custom-checkbox'><input type='checkbox' class='custom-control-input' id='select"+cont+"' name='select' value='"+json[label].id+"'></div></th>"+
										"<td style='max-width: 100px;'>"+ json[label].fecha+
										"<input type='hidden' form='print' name='idnoConformidad[]'"+
										"value='"+json[label].id+"'></td>"+
										"<td style='max-width: 100px;'>"+json[label].ultimaAct+"</td>"+
										"<td style='max-width: 180px;'>"+ json[label].titulo+"</td>"+
										"<td style='max-width: 110px;'>"+ json[label].tipo+"</td>"+
										"<td style='max-width: 100px;'>"+ json[label].auditado+"</td>"+
										"<td style='max-width: 300px;'>"+ json[label].descripcion+"</td>"+
										"<td>"+ json[label].estado+"</td></tr>");
									$('#select'+cont).change(function() {
								        if ($(this).is(':checked')) {
								            $('input[type="checkbox"]').prop("checked", false); //uncheck all checkboxes
  											$(this).prop("checked", true);  //check the clicked one
								        };
					    			});
								});
							});
						});

						$("#estado").change(function(){
							
							var e = document.getElementById("estado");
							
							var estado = e.value;	
							
							$("#tpendientes>tbody").empty();
							
							$.post("listado_estado",{estado: estado, },function(result){	
								
								var cont = 0;
								
								var json = JSON.parse(result);
								
								
								
								json.forEach(function(value,label){
									cont++;
									$("#tpendientes>tbody").append("<tr class='pedidosT__row'><th scope='row'><div class='custom-control custom-checkbox'><input type='checkbox' class='custom-control-input' id='select"+cont+"' name='select' value='"+json[label].id+"'></div></th>"+
										"<td style='max-width: 100px;'>"+ json[label].fecha+
										"<input type='hidden' form='print' name='idnoConformidad[]'"+
										"value='"+json[label].id+"'></td>"+
										"<td style='max-width: 100px;'>"+ json[label].ultimaAct+"</td>"+
										"<td style='max-width: 180px;'>"+ json[label].titulo+"</td>"+
										"<td style='max-width: 110px;'>"+ json[label].tipo+"</td>"+
										"<td style='max-width: 100px;'>"+ json[label].auditado+"</td>"+
										"<td style='max-width: 300px;'>"+ json[label].descripcion+"</td>"+
										"<td>"+ json[label].estado+"</td></tr>");
									$('#select'+cont).change(function() {
								        if ($(this).is(':checked')) {
								            $('input[type="checkbox"]').prop("checked", false); //uncheck all checkboxes
  											$(this).prop("checked", true);  //check the clicked one
								        };
					    			});
								});
							});
						});


					});
				</script> 
				
			
		</form> 
	</div>	 
<!-- <script type = 'text/javascript' src = "<?php echo base_url();?>js/comprasJava.js"></script> -->
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuRegistrosJava.js"></script>