
	<div class="container">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i>  REPORTES: </h3>
		</div>
		<form method="POST" id = "global" action="<?php echo site_url('registros/pdfReportes'); ?>">
			<div class="container_insert">	  
				<div class="container__form">
					<div class="col-md-4">
						<label for="iestado">Política:</label>
						<select class="form-control" id="politica" name="politica" >
							<option value="">Filtrar por política......</option>
							<option value='CALIDAD'> CALIDAD </option>
							<option value='INTEGRIDAD'> INTEGRIDAD </option>
							<option value='TRABAJO EN EQUIPO'> TRABAJO EN EQUIPO </option>
							<option value='SEGURIDAD, SALUD Y MEDIO AMBIENTE'> SEGURIDAD, SALUD Y MEDIO AMBIENTE </option>
						</select>  
					</div>
					<div class="col-md-4">
						<label for="iestado">Personal:</label>
						<select class="form-control" id="empleado" name="empleado">
							<option selected value=''> Personal... </option>
							<?php
							  	$arrayLength = count($empleados);
								$i = 0;
								while ($i < $arrayLength) {?>
									<option value='<?php echo $empleados[$i]->nombre;?>'><?php echo $empleados[$i]->nombre." ".$empleados[$i]->apellido;?></option>
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
							<th scope='col' style="min-width: 100px;">Fecha</th>
							<th scope='col'>Personal</th>
							<th scope='col'>Política</th>
							<th scope='col'>Logro</th>
							<th scope='col'>Sector</th>
							<th scope='col'>Aprobó</th>
						</tr>
					</thead>
				  	<tbody>
				  		
				  			<?php
							  	$arrayLength = count($meritos);
								$i = 0;
								while ($i < $arrayLength) {?>
									<tr class='pedidosT__row'>
									<td><?php echo $meritos[$i]->fecha;?></td>
									<td><?php echo $meritos[$i]->empleado;?></td>
									<td><?php echo $meritos[$i]->politica;?></td>
									<td><?php echo $meritos[$i]->logro;?></td>
									<td><?php echo $meritos[$i]->sector;?></td>
									<td><?php echo $meritos[$i]->aprobo;?></td>
									</tr>	
							 	<?php
								$i++;
								}
								?>	
				  		
					</tbody>	
				</table>
				<script type="text/javascript">
					$(document).ready(function(){

						

						$("#politica").change(function(){
							
							var e = document.getElementById("politica");
							
							var politicaMerito = e.value;	
							
							$("#tpendientes>tbody").empty();

							$.post("listado",{politicaMerito: politicaMerito, },function(result){	
								
								var cont = 0;
								
								var json = JSON.parse(result);
								
								
								
								json.forEach(function(value,label){
									cont++;
									$("#tpendientes>tbody").append("<tr class='pedidosT__row'>"
										+"<td>"+ json[label].fecha+"</td>"
										+"<td>"+ json[label].empleado+"</td>"
										+"<td>"+ json[label].politica+"</td>"
										+"<td>"+ json[label].logro+"</td>"
										+"<td>"+ json[label].sector+"</td>"
										+"<td>"+ json[label].aprobo+"</td></tr>");

								});
							});
						});

						$("#empleado").change(function(){
							
							var e = document.getElementById("empleado");
							
							var empleado = e.value;	
							
							$("#tpendientes>tbody").empty();

							$.post("listado_empleado",{empleado: empleado, },function(result){	
								
								var cont = 0;
								
								var json = JSON.parse(result);
								
								
								
								json.forEach(function(value,label){
									cont++;
									$("#tpendientes>tbody").append("<tr class='pedidosT__row'><th scope='row'><div class='custom-control custom-checkbox'><input type='checkbox' class='custom-control-input' id='select"+cont+"' name='select[]' value='"+json[label].id+"'></div></th>"+
										"<td>"+ json[label].fecha+"</td>"+
										"<td>"+ json[label].nombre+" "+json[label].apellido+"</td>"+
										"<td>"+ json[label].tipo+"</td><td>"+ json[label].descripcion+"</td>"+
										"</tr>");
								});
							});
						});

					});
				</script> 
				
			
		</form> 
	</div>	 
<!-- <script type = 'text/javascript' src = "<?php echo base_url();?>js/comprasJava.js"></script> -->
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuRegistrosJava.js"></script>