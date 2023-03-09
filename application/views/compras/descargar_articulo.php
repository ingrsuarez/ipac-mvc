
	<div class="container">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i>  DESCARGAR ARTICULO: </h3>
		</div>
		<form method="POST" id = "global" action="<?php echo site_url('compras/descargarArticulo'); ?>">
			<div class="container_wide">	  
				<div class="container__form">
					<div class="col-md-4">
						<label for="nombre">Articulo</label>
						<input type="text" name="nombre" id="nombre" autocomplete="off" autofocus>
						<label for="brand">Marca</label>
						<input type="text" class="form-control" id="brand" name="brand">
					</div>
					
					<div class="container__button">
						<button type="submit" class="btn btn-insert" form = "global">Descargar</button>
					</div>
				</div>				
			
			</div>		
			
				<table class='pedidosT' id="tpendientes">
					
					<thead>
						<tr class="pedidosT__encabezado">
							<th scope='col'>#</th>
							<th scope='col'>En Stock</th>
							<th scope='col'>Nombre</th>
							<th scope='col'>Marca</th>
							<th scope='col'>Cantidad</th>
						</tr>
					</thead>
				  	<tbody>
				  		
					</tbody>	
				</table>
			
				<script type="text/javascript">

					$(document).ready(function(){

						var m = document.getElementById("brand");
						

						var e = document.getElementById("nombre");
						e.addEventListener("keyup",function(event){
							
							var nombre = e.value;
							// console.log(event);
							
							
							
			
							$.post("descargarArticulo/find",{nombre: nombre},function(result){	

								$("#tpendientes>tbody").empty();
								var cont = 0;
								var json = JSON.parse(result);

								json.forEach(function(value,label){
									cont++;
									$("#tpendientes>tbody").append("<tr class='pedidosT__row'><th scope='row' class = 'pedidosT__fecha'><div class='custom-control"
										+" custom-checkbox'><input type='checkbox' class='custom-control-input' id='select"+cont+"' name='artselect[]' value='"+json[label].id+"'></div></th>"
										+"<td><input type='hidden' form='global' name = 'total[]' value='"+json[label].cantidad
										+"'>"+json[label].cantidad+"</td>"
										+"<td><input type='hidden' name = 'articulo[]' value='"+json[label].id+"'>"+ json[label].nombre+"</td>"
										+"<td>"+json[label].marca+"</td>"
										+"<td><input type='number' name = 'cantidad[]' max='"+json[label].cantidad+"' style ='width:60px'></td>"
										+"</tr>");

									
								});
							});
							
						});
					
						//BRAND SEARCH
						m.addEventListener("input",function(){
							// var key = event.data;
								
							var brand = m.value;
							
							$("#tpendientes>tbody").empty();
							
							$.post("descargarArticulo/findBrand",{brand: brand},function(result){	

								// alert("Escribió: "+result);
								var cont = 0;
								var json = JSON.parse(result);

								json.forEach(function(value,label){
									cont++;
									$("#tpendientes>tbody").append("<tr class='pedidosT__row'><th scope='row' class = 'pedidosT__fecha'><div class='custom-control"
										+" custom-checkbox'><input type='checkbox' class='custom-control-input' id='select"+cont+"' name='artselect[]' value='"+json[label].id+"'></div></th>"
										+"<td><input type='hidden' form='global' name = 'total[]' value='"+json[label].cantidad
										+"'>"+json[label].cantidad+"</td>"
										+"<td><input type='hidden' name = 'articulo[]' value='"+json[label].id+"'>"+ json[label].nombre+"</td>"
										+"<td>"+json[label].marca+"</td>"
										+"<td><input type='number' name = 'cantidad[]' max='"+json[label].cantidad+"' style ='width:60px'></td>"
										+"</tr>");

									
								});
							});
						});


					});
				</script> 
				
			
		</form> 
	</div>	 
<!-- <script type = 'text/javascript' src = js/recibirOC.js"></script> -->
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuComprasJava.js"></script>
