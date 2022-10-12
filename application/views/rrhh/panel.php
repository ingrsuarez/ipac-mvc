

 <div class="container-grid fifty">


	<div class="item-grid item1">
		<div class="row">	
		<form method="POST" action="<?php echo site_url('rrhh/insertar_licencia'); ?>"  id="ingresoVacaciones">
			
				<h3 class="container_title"><i class="fas fa-suitcase" ></i>    REGISTRAR LICENCIA:</h3>

				<div class="column">	
					<div class="input-container">
						<i class="fa-solid fa-book iconSelect"></i>
						
						<select class="select-field" id="tipo" name="tipo" autofocus >
						
							<option value='' selected>Tipo</option>
							<option value='enfermedad'>Enfermedad</option>
							<option value='inasistencia'>Inasistencia</option>
							<option value='vacaciones'>Vacaciones</option>
							<option value='especial'>Especial</option>
							
					  	</select>
					</div>
					<div class="input-container">
					</div>
					
				</div>
	
				<div class="column">
					<div class="input-container">
						<i class="fa-solid fa-user-group iconSelect"></i>
						<select class="select-field" id="empleados" name="empleado">
							<option value="">Seleccione empleado...</option>
						<?php
						  	$arrayLength = count($empleados);
							$i = 0;
							while ($i < $arrayLength) {?>
								<option value='<?php echo $empleados[$i]->id;?>'><?php echo ucfirst($empleados[$i]->nombre." ".$empleados[$i]->apellido);?></option>
						 	<?php
							$i++;
							}
						?>	
						</select> 

					</div>
					<div class="input-container">
						<i class="fa-solid fa-book iconSmall"></i>
						<input type="text" class="input-field" id="medico" name="medico" placeholder="Médico">	
					</div>

				</div>
			
				<div class="column">

							<div class="input-container">
								<i class="fa-solid fa-calendar iconSmall"></i>
														
								<input type="date" class="select-field" id="fechai" name="fechai">	
							</div>
							<div class="input-container">
								<i class="fa-solid fa-calendar iconSmall"></i>
								
								<input type="date" class="select-field" id="fechafin" name="fechafin">	
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
			
	</div>
	<div class="item-grid item1">
	</div>
 	
 	<div class="item-grid span2">
 			
 		
		<div class="row">
			<h3 class="container_title"><i class="fas fa-tasks"></i>  LICENCIAS EN REVISION: </h3>
			<table class='dataTable'>
				
				<thead>
					<tr class="pedidosT__encabezado">
					  <th class="pedidosT__fecha" scope='col'>Fecha </th>
					  <th class="pedidosT__usuario" scope='col'>Usuario</th>
					  <th scope='col'>Fecha Inicial</th>
					  <th scope='col'>Fecha Final</th>
					  <th scope="col">Días</th>
					  <th scope='col'>Tipo</th>
					  <th scope='col'>Estado</th>
					  <th scope="col" colspan="2">Acción </th>
					</tr>
				</thead>
				<tbody>
				<?php	
				$arrayLength = count($licencias);
				$i = 0;
				
				while ($i < $arrayLength) {?>
					<tr class="pedidosT__row">						
						<td style="min-width: 110px"> <?php echo $licencias[$i]->fecha;?></td>
						<td> <?php echo $licencias[$i]->nombre;?></td>
						<td style="min-width: 110px"> <?php echo $licencias[$i]->fechaini;?></td>
						<td style="min-width: 110px"> <?php echo $licencias[$i]->fechafin;?></td>
						<td> <?php echo $licencias[$i]->dias;?></td>	
						<td> <?php echo $licencias[$i]->tipo;?></td>	
						<td> <a href="<?php echo base_url(); ?>index.php/rrhh/panel/<?php echo $licencias[$i]->id?>"><?php echo $licencias[$i]->estado;?></a></td>	
						<td><form action="<?php echo base_url(); ?>index.php/rrhh/panel/aprobar" id='edit<?php echo$i?>' method ='POST'>
							<input type="hidden" name="licencia" value="<?= $licencias[$i]->id?>">
							<input type="hidden" name="tipo" value="<?= $licencias[$i]->tipo?>">
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

 	
 </div>