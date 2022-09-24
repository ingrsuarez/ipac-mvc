
	<div class="container">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i>  REMITOS: </h3>
		</div>
		<form method="POST" id = "global" action="<?php echo site_url('compras/remitos'); ?>">
			<div class="container_wide">	  
				<div class="container__form">
					<div class="col-md-4">
						<label for="lastNumber">Remito: </label>
						<input type="text" class="form-control" id="lastNumber" name="lastNumber" maxlength="8" style="width: 80px;"  autofocus>

						<select class="form-control" id="iproveedor" name="iproveedor">
							<option value="">Seleccione un proveedor...</option>
						<?php
						  	$arrayLength = count($proveedores);
							$i = 0;
							while ($i < $arrayLength) {?>
								<option value='<?php echo $proveedores[$i]->nombre;?>'><?php echo $proveedores[$i]->nombre;?></option>
						 	<?php
							$i++;
							}
						?>	
						</select>  
						<label for="articulo">Articulo: </label>
						<input type="text" class="form-control" id="articulo" name="articulo" style="width: 180px;">
					</div>
					<div class="container__button">
						<button type="submit" class="btn btn-insert" form = "global">Ingresar</button>
					</div>
				</div>				
			
			</div>		

				<table class='pedidosT' id="tpendientes">
					<caption><h2>SELECCIONAR</h2>  </caption>
					<thead>
						<tr class="pedidosT__encabezado">
							<th scope='col'>Fecha</th>
							<th scope='col'>Número</th>
							<th scope='col'>Artículos</th>
							<th scope='col'>Cantidad</th>
							<th scope="col">Proveedor</th>
							<th scope='col'>Ingresó</th>
						</tr>
					</thead>
				  	<tbody>
					</tbody>	
				</table>
				<script type="text/javascript">
					$(document).ready(function(){

						var inputNumber = document.getElementById('lastNumber');
						var idProveedor = document.getElementById('iproveedor');
						var articulo = document.getElementById('articulo');

						inputNumber.addEventListener('input',function(){

							var remitoLastNumber = inputNumber.value;	
							
							$("#tpendientes>tbody").empty();

							$.post("remito",{remitoLastNumber: remitoLastNumber},function(result){	
								
								var cont = 0;
								
								var json = JSON.parse(result);

								json.forEach(function(value,label){
									cont++;
									$("#tpendientes>tbody").append("<tr class='pedidosT__row'><th scope='row' class = 'pedidosT__fecha'>"+json[label].fecha+"</th>"
										+"<td><input type='hidden' name = 'pedido[]' value='"+json[label].remito
										+"'>"+ "<input type='hidden' name = 'articulo[]' value='"+json[label].articulo+"'>"+json[label].remito+"</td>"
										+"<td><input type='hidden' name = 'ocnumber[]' value='"+json[label].remito+"'>"+ json[label].articulo+"</td>"
										+"<td>"+ json[label].cantidad+"</td>"
										+"<td>"+ json[label].proveedor+"</td>"
										+"<td>"+ json[label].usuario+"</td>"
										+"</tr>");

									
								});
							});
						});

						iproveedor.addEventListener('input',function(){

							var proveedor = iproveedor.value;	
							
							$("#tpendientes>tbody").empty();

							$.post("proveedor",{iproveedor: proveedor},function(result){	
								
								var cont = 0;
								
								var json = JSON.parse(result);
								json.forEach(function(value,label){
									cont++;
									$("#tpendientes>tbody").append("<tr class='pedidosT__row'><th scope='row' class = 'pedidosT__fecha'>"+json[label].fecha+"</th>"
										+"<td><input type='hidden' name = 'pedido[]' value='"+json[label].remito
										+"'>"+ "<input type='hidden' name = 'articulo[]' value='"+json[label].articulo+"'>"+json[label].remito+"</td>"
										+"<td><input type='hidden' name = 'ocnumber[]' value='"+json[label].remito+"'>"+ json[label].articulo+"</td>"
										+"<td>"+ json[label].cantidad+"</td>"
										+"<td>"+ json[label].proveedor+"</td>"
										+"<td>"+ json[label].usuario+"</td>"
										+"</tr>");

									
								});
							});
						});


						articulo.addEventListener('input',function(){

							var nombreArticulo = articulo.value;	
							
							$("#tpendientes>tbody").empty();

							$.post("articulo",{nombreArticulo: nombreArticulo},function(result){	
								
								var cont = 0;
								
								var json = JSON.parse(result);

								json.forEach(function(value,label){
									cont++;
									$("#tpendientes>tbody").append("<tr class='pedidosT__row'><th scope='row' class = 'pedidosT__fecha'>"+json[label].fecha+"</th>"
										+"<td><input type='hidden' name = 'pedido[]' value='"+json[label].remito
										+"'>"+ "<input type='hidden' name = 'articulo[]' value='"+json[label].articulo+"'>"+json[label].remito+"</td>"
										+"<td><input type='hidden' name = 'ocnumber[]' value='"+json[label].remito+"'>"+ json[label].articulo+"</td>"
										+"<td>"+ json[label].cantidad+"</td>"
										+"<td>"+ json[label].proveedor+"</td>"
										+"<td>"+ json[label].usuario+"</td>"
										+"</tr>");

									
								});
							});
						});


					});
				</script> 
				
			
		</form> 
	</div>	 
<!-- <script type = 'text/javascript' src = "<?php echo base_url();?>js/recibirOC.js"></script> -->
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuComprasJava.js"></script>
