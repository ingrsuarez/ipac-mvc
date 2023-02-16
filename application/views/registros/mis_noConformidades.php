
	<div class="container">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i> MIS NO CONFORMIDADES: </h3>
		</div>
		<form method="POST" id = "global" action="<?php echo site_url('registros/editar_noConformidad'); ?>">
			<div class="container_insert">	  
				<div class="container__form">
					<div class="col-md-4">
						<label for="iestado">Tipo:</label>
						<select class="form-control" id="tipo" name="tipo" autofocus>
							<option value="">Seleccione tipo......</option>
							<option value='NO SE SIGUE EL PROCEDIMIENTO'> NO SE SIGUE EL PROCEDIMIENTO </option>
							<option value='ERROR DE INGRESO'> ERROR DE INGRESO </option>
							<option value='TAREAS SIN REALIZAR'> TAREAS SIN REALIZAR </option>
							<option value='NO SE CONOCE EL PROCEDIMIENTO'> NO SE CONOCE EL PROCEDIMIENTO </option>
							<option value='PRODUCTIVIDAD'> PRODUCTIVIDAD </option>
						</select>  
					</div>
					<div class="container__button">
						
						<button type="submit" class="btn btn-insert" name="action" value="print" form = "global">Descargar</button>
					</div>
				</div>				
			
			</div>		

				<table class='pedidosT' id="tpendientes">
					
					<thead>
						<tr class="pedidosT__encabezado">
							<th scope='col' style="min-width: 100px;">Fecha</th>
							<th scope='col'>Título</th>
							<th scope='col'>Tipo</th>
							<th scope='col'>Descripción</th>
							<th scope="col">Estado </th>
						</tr>
					</thead>
				  	<tbody>
				  	
						<?php	
						$arrayLength = count($noConformidades);
						$i = 0;
						
						while ($i < $arrayLength) {?>
							<tr class="pedidosT__row">						
								<td class="pedidosT__fecha"> <?php echo $noConformidades[$i]->fecha;?></td>
								<td> <?php echo $noConformidades[$i]->titulo."-";?></td>
								<td> <?php echo $noConformidades[$i]->tipo;?></td>
								<td> <?php echo $noConformidades[$i]->descripcion;?></td>
								<td> <?php echo $noConformidades[$i]->estado;?></td>						
							</tr><?php
							$i++;
							}
						?>	  

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
								console.log(json);
								json.forEach(function(value,label){
									cont++;
									
									$("#tpendientes>tbody").append("<tr class='pedidosT__row' onclick='getIndex(this)'><th scope='row'><div class='custom-control custom-checkbox'><input type='checkbox' class='custom-control-input' id='select"+cont+"' name='select' value='"+json[label].id+"'></div></th>"+
										"<td style='max-width: 100px;'>"+ json[label].fecha+
										"<input type='hidden' name='idnoConformidad'"+
										"value='"+json[label].id+"'></td>"+
										"<td style='max-width: 100px;'>"+ json[label].ultimaAct+"</td>"+
										"<td style='max-width: 180px;'>"+ json[label].titulo+"</td>"+
										"<td style='max-width: 110px;'>"+ json[label].tipo+"</td>"+
										"<td style='max-width: 100px;'>"+ json[label].nombre+" "+json[label].apellido+"</td>"+
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

<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuRegistrosJava.js"></script>