
	<div class="container">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i>  IMPRIMIR ORDEN DE COMPRA: </h3>
		</div>
		<form method="POST" id = "global" action="<?php echo site_url('compras/pdfoc'); ?>">
			<div class="container_insert">	  
				<div class="container__form">
					<div class="col-md-4">
						<select class="form-control" id="iproveedor" name="iproveedor" >
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
						<button type="submit" class="btn btn-insert" name="sinprov">Dejar sin proveedor</button>
						<button type="submit" class="btn btn-insert" name="pdf" form = "global">Descargar</button>
					</div>
				</div>				
			
			</div>		

				<table class='pedidosT' id="tpendientes">
					<caption><h2>SELECCIONAR</h2>  </caption>
					<thead>
						<tr>
							<th scope='col'>#</th>
							<th scope='col'>Número</th>
							<th scope='col'>Artículos</th>
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
									$("#tpendientes>tbody").append("<tr><th scope='row'><div class='custom-control custom-checkbox'><input type='checkbox' class='custom-control-input' id='select"+cont+"' name='ocselect' value='"+json[label].numero+"'></div></th><td>"+ json[label].numero+"</td><td>"+ json[label].articulos+"</td></tr>");
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
<script type = 'text/javascript' src = "<?php echo base_url();?>js/comprasJava.js"></script>
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuComprasJava.js"></script>