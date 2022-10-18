
	<div class="container">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i>  ORDENES DE TRABAJO: </h3>
		</div>
		<form method="POST" id = "global" action="<?php echo site_url('registros/pdf_orden_trabajo'); ?>">
			<div class="container_insert">	  
				<div class="container__form">
					<div class="col-md-4">
						<label for="iestado">Estado:</label>
						<select class="form-control" id="iestado" name="iestado" >
							<option value="">Seleccione estado......</option>
							<option value="activa">ACTIVAS</option>
							<option value="revision">REVISION</option>
							<option value="cerrada">CERRADA</option>
						</select>  
					</div>
				
					<div class="col-md-4">
						<label for="iequipo">Equipo:</label>
						<select class="form-control" id="iequipo" name="iequipo" required>
							<option selected value=''> Equipo... </option>
							<?php
								  	$arrayLength = count($activos);
									$i = 0;
									while ($i < $arrayLength) {?>
										<option value='<?php echo $activos[$i]->nombre;?>'><?php echo ucfirst($activos[$i]->nombre." - ".$activos[$i]->modelo);?></option>
								 	<?php
									$i++;
									}
								?>	
						</select>  
					</div>

					<div class="container__button">
						
						<button type="submit" class="btn btn-insert" name="action" value="print" form = "global">Descargar</button>
					</div>
				</div>				
			
			</div>		

				<table class='pedidosT' id="tpendientes">
					<caption><h2>SELECCIONAR</h2>  </caption>
					<thead>
						<tr class="pedidosT__encabezado">
							<th scope='col'>#</th>
							<th scope='col'>Fecha</th>
							<th scope='col'>Equipo</th>
							<th scope='col'>Tipo</th>
							<th scope="col" style="max-width: 100px;">Descripción</th>
							<th scope="col">Usuario</th>
							<th scope='col'>Estado</th>
						</tr>
					</thead>
				  	<tbody>
					</tbody>	
				</table>
				<script type="text/javascript">
					$(document).ready(function(){

						

						$("#iestado").change(function(){
							
							var e = document.getElementById("iestado");
							
							var estadoOrden = e.value;	
							
							$("#tpendientes>tbody").empty();

							$.post("listado",{estadoOrden: estadoOrden, },function(result){	
								// var data = JSON.parse(result);
								var cont = 0;
								
								var json = JSON.parse(result);
								
								
								
								json.forEach(function(value,label){
									cont++;
									$("#tpendientes>tbody").append("<tr class='pedidosT__row'><th scope='row'><div class='custom-control custom-checkbox'><input type='checkbox' class='custom-control-input' id='select"+cont+"' name='select' value='"+json[label].id+"'></div></th><td>"+ json[label].fecha+"</td><td style='max-width: 120px;'>"+ json[label].equipo+"</td><td style='max-width: 120px;'>"+ json[label].tipo+"</td><td style='max-width: 280px;'>"+ json[label].descripcion+"</td><td>"+ json[label].nombre+"</td><td>"+ json[label].estado+"</td></tr>");
									$('#select'+cont).change(function() {
								        if ($(this).is(':checked')) {
								            $('input[type="checkbox"]').prop("checked", false); //uncheck all checkboxes
  											$(this).prop("checked", true);  //check the clicked one
								        };
					    			});
								});
							});
						});


						$("#iequipo").change(function(){
							
							var e = document.getElementById("iequipo");
							
							var iequipo = e.value;	
							
							$("#tpendientes>tbody").empty();

							$.post("equipo",{iequipo: iequipo, },function(result){	
								// var data = JSON.parse(result);
								var cont = 0;
								
								var json = JSON.parse(result);
								
								json.forEach(function(value,label){
									cont++;
									$("#tpendientes>tbody").append("<tr class='pedidosT__row'><th scope='row'><div class='custom-control custom-checkbox'><input type='checkbox' class='custom-control-input' id='select"+cont+"' name='select' value='"+json[label].id+"'></div></th><td>"+ json[label].fecha+"</td><td style='max-width: 120px;'>"+ json[label].equipo+"</td><td style='max-width: 120px;'>"+ json[label].tipo+"</td><td style='max-width: 280px;'>"+ json[label].descripcion+"</td><td>"+ json[label].nombre+"</td><td>"+ json[label].estado+"</td></tr>");
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