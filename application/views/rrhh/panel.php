

 <div class="container-grid">


	<div class="item-grid item1">
			
		<form method="POST" action="<?php echo site_url('rrhh/insertar_licencia'); ?>"  id="ingresoVacaciones">
			
				<h3 class="container_title"><i class="fas fa-suitcase" ></i>   LICENCIA:</h3>
				<div class="column">	
						<label class="input-group-text" for="fechai">Días disponibles: <?php echo $vacaciones;?></label>
				</div>	
			
				<div class="column">

							<div class="col-md-4">
								<label for="fechai">Fecha inicial: </label>							
								<input type="date" class="custom-control-input" id="fechai" name="fechai">	
							</div>
							<div class="col-md-4">
								<label class="input-group-text" for="fechai">Fecha final: </label>
								<input type="date" class="custom-control-input" id="fechafin" name="fechafin">	
							</div>
						<script type="text/javascript">
							$(document).ready(function(){
								$("#fechai").change(function(){
									var diasd = 0;


								})


							});

						</script>
						
				</div>
				<div class="column">
					<div class="col">
						<button type="submit" class="btn btn-register" name="registrar">Registrar</button>	
					</div>
				</div>
						
			</form>	
	</div>

 	
 	<div class="item-grid item2">
 			
 		
		<div class="row">
			<h3 class="container_title"><i class="fas fa-tasks"></i>  LICENCIAS EN REVISION: </h3>
			<table class='pedidosT'>
				
				<thead>
					<tr class="pedidosT__encabezado">
					  <th class="pedidosT__fecha" scope='col'>Fecha </th>
					  <th class="pedidosT__usuario" scope='col'>Usuario</th>
					  <th scope='col'>Fecha Inicial</th>
					  <th scope='col'>Fecha Final</th>
					  <th scope='col'>Tipo</th>
					  <th scope='col'>Estado</th>
					</tr>
				</thead>
				<tbody>
				<?php	
				$arrayLength = count($licencias);
				$i = 0;
				
				while ($i < $arrayLength) {?>
					<tr class="pedidosT__row">						
						<td style="min-width: 120px"> <?php echo $licencias[$i]->fecha;?></td>
						<td> <?php echo $licencias[$i]->nombre;?></td>
						<td style="min-width: 120px"> <?php echo $licencias[$i]->fechaini;?></td>
						<td style="min-width: 120px"> <?php echo $licencias[$i]->fechafin;?></td>
						<td> <?php echo $licencias[$i]->tipo;?></td>	
						<td> <a href="<?php echo base_url(); ?>index.php/rrhh/panel/<?php echo $licencias[$i]->id?>"><?php echo $licencias[$i]->estado;?></a></td>	
						<td><form action="<?php echo base_url(); ?>index.php/rrhh/panel/aprobar" id='edit<?php echo$i?>' method ='POST'>
							<input type="hidden" name="licencia" value="<?= $licencias[$i]->id?>">
							<button type='submit' class='btn btn-delete' name='edit'>APROBAR</button>
						</form></td>
						<td><form action="<?php echo base_url(); ?>index.php/rrhh/panel/rechazar" id='edit<?php echo$i?>' method ='POST'>
							<input type="hidden" name="licencia" value="<?= $licencias[$i]->id?>">
							<button type='submit' class='btn btn-delete' name='edit'>RECHAZAR</button>
						</form></td>				
					</tr><?php
					$i++;
					}
					 ?>	  
				</tbody>
			</table>
		</div>
 	</div>
 	<div class="item-grid item3">
 		
			
						

 	</div>	
 	<!-- <div class="item-grid item6"></div> -->
 	
 </div>