
	<div class="container">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i>  INGRESAR ARTICULO: </h3>
		</div>
		<form method="POST" id = "global" action="<?php echo site_url('compras/ingresarArticulo'); ?>">
			<div class="container_wide">	  
				<div class="container__form">
					<div class="col-md-4">
						<label for="nombre">Nombre</label>
						<input type="text" name="nombre" id="nombre" style="width: 180px;" autofocus>
						<label for="first">Marca: </label>
						<input type="text" class="form-control" id="brand" name="brand" style="width: 180px;">
					</div>
					<div class="col-md-4">
						<label for="sector">SECTOR:</label>
						<select class="form-control" id="iproveedor" name="sector">
							<option value="">Seleccione un sector...</option>
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
					<div class="col-md-4">
						<label for="sector">UNDAD:</label>
						<select class="form-control" id="unidad" name="unidad">
							<option value="">Seleccione la unidad...</option>
							<option value="u">Unidad</option>
							<option value="ml">ml</option>
							<option value="dt">determinaciones</option>
							<option value="gr">gramos</option>
							<option value="lt">litros</option>
							
						</select>  
					
						<label for="sector">TIPO:</label>
						<select class="form-control" id="tipo" name="tipo">
							<option value="">Seleccione el tipo...</option>
							<option value='RE'>Reactivo</option>
							<option value='DE'>Descartable</option>
							<option value='CC'>Control, calibrador</option>
							<option value='EQ'>Equipamiento</option>
							<option value='LIM'>Limpieza</option>
							<option value='AG'>Aguas</option>
							<option value='REP'>Repuesto</option>
							<option value='VE'>Veterinarios</option>
							<option value='LIB'>Librería</option>
							<option value='MQ'>Marqueting</option>
							
						</select>  
					</div>
					<div class="col-md-4">
						<label for="nombre">Nombre alternativo 1:</label>
						<input type="text" name="alt1" style="width: 180px;" autofocus>
						<label for="first">Nombre alternativo 2: </label>
						<input type="text" class="form-control" id="brand" name="alt2" style="width: 180px;">
					</div>
					<div class="container__button">
						<button type="submit" class="btn btn-insert" form = "global">Ingresar</button>
					</div>
				</div>				
			
			</div>		

				<table class='pedidosT' id="tpendientes">
					
					<thead>
						<tr class="pedidosT__encabezado">

							<th scope='col'>En Stock</th>
							<th scope='col'>Nombre</th>
							<th scope='col'>Marca</th>
							
						</tr>
					</thead>
				  	<tbody>
				  		
					</tbody>	
				</table>
			
				<script type="text/javascript">
					$(document).ready(function(){

						var e = document.getElementById("nombre");
						
						e.addEventListener("input",function(){
							var key = event.data;
							// var articulo = e.value;	
							var nombre = e.value;
							// alert("ADENTRO "+nombre);
							$("#tpendientes>tbody").empty();
							
							// alert("Escribió: "+nombre);

							$.post("ingresarArticulo/find",{nombre: nombre},function(result){	

								// alert("Escribió: "+result);
								var cont = 0;
								var json = JSON.parse(result);

								json.forEach(function(value,label){
									cont++;
									$("#tpendientes>tbody").append("<tr class='pedidosT__row'><td>"
										+json[label].cantidad+"</td>"
										+"<td>"+ json[label].nombre+"</td>"
										+"<td>"+json[label].marca+"</td>"
										+"</tr>");

									
								});
							});
						});
					});
				</script> 
				
			
		</form> 
	</div>	 
<script type = 'text/javascript' src = "<?php echo base_url();?>js/recibirOC.js"></script>
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuComprasJava.js"></script>
