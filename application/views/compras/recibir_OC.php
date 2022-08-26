
	<div class="container">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i>  RECIBIR PEDIDO: </h3>
		</div>
		<form method="POST" id = "global" action="<?php echo site_url('compras/recibirOC'); ?>">
			<div class="container_wide">	  
				<div class="container__form">
					<div class="col-md-4">
						<label for="fecha">Fecha</label>
						<input type="date" name="fecha">
					<!-- </div>
					<div class="col-md-4"> -->
						<label for="first">/	        Remito</label>
						<input type="text" class="form-control" id="firstNumber" name="first" maxlength="4" style="width: 45px;">
						- <input type="text" class="form-control" id="lastNumber" name="last" maxlength="8" style="width: 80px;">
					</div>
					<div class="col-md-4">
						<select class="form-control" id="iproveedor" name="iproveedor" autofocus>
							<option value="">Seleccione un proveedor...</option>
						<?php
						  	$arrayLength = count($proveedores);
							$i = 0;
							while ($i < $arrayLength) {?>
								<option value='<?php echo $proveedores[$i]->id;?>'><?php echo $proveedores[$i]->nombre;?></option>
						 	<?php
							$i++;
							}
						?>	
						</select>  
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
							<th scope='col'>#</th>
							<th scope='col'>Número</th>
							<th scope='col'>Artículos</th>
							<th scope='col'>Cantidad</th>
							<th scope='col'>Lote</th>
							<th scope='col'>Vencimiento</th>
						</tr>
					</thead>
				  	<tbody>
					</tbody>	
				</table>
				<script type="text/javascript">
					$(document).ready(function(){

						

						$("#iproveedor").change(function(){
							
							var e = document.getElementById("iproveedor");
							
							var idProveedor = e.value;	
							
							$("#tpendientes>tbody").empty();

							$.post("ocPendientes",{iproveedor: idProveedor},function(result){	
								// var data = JSON.parse(result);
								var cont = 0;
								
								var json = JSON.parse(result);
								
								
								
								json.forEach(function(value,label){
									cont++;
									$("#tpendientes>tbody").append("<tr class='pedidosT__row'><th scope='row' class = 'pedidosT__fecha'><div class='custom-control"
										+" custom-checkbox'><input type='checkbox' class='custom-control-input' id='select"+cont+"' name='ocselect[]' value='"+json[label].pedido+"'></div></th>"
										+"<td><input type='hidden' name = 'pedido[]' value='"+json[label].pedido
										+"'>"+ "<input type='hidden' name = 'articulo[]' value='"+json[label].articulo+"'>"+json[label].numero+"</td>"
										+"<td><input type='hidden' name = 'ocnumber[]' value='"+json[label].id+"'>"+ json[label].descripcion+"</td>"
										+"<td><input type='number' name = 'cantidad[]' max = '"+ json[label].cantidad+"' style ='width:50px'></td>"
										+"<td><input type='text' name = 'lote[]' style ='width:100px'></td>"
										+"<td><input type='date' name = 'vencimiento[]'></td>"
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
