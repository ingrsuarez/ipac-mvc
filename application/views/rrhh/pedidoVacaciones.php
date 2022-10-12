

 <div class="container-grid third">


	<div class="item-grid item1">
			
			<form method="POST" action="<?php echo site_url('rrhh/solicitar_vacaciones'); ?>"  id="ingresoVacaciones">
			
				<h3 class="container_title"><i class="fas fa-suitcase" ></i>   VACACIONES</h3>
				<div class="column">
					<div class="input-container">	
						<label class="custom-control-input" for="fechai">Días disponibles: <?php echo $vacaciones;?></label>
					</div>
				</div>	
				<div class="column">
					<label for="fechai">Fecha inicial: </label>	
					<div class="input-container">

								<i class="fa-solid fa-calendar iconSmall"></i>
														
								<input type="date" class="select-field" id="fechai" name="fechai">	
							</div>
				</div>



				<div class="column">
					<label for="fechafin">Fecha final: </label>

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

 	
 	<div class="item-grid item1">
 			
 		
		<div class="row">
			<h3 class="container_title"><i class="fas fa-tasks"></i>  LICENCIAS DEL AÑO: </h3>
			<table class='pedidosT' id="tabla_licencias">
				
				<thead>
					<tr class="pedidosT__encabezado">
					  <th scope="col">#</th>
					  <th class="pedidosT__fecha" scope='col'>Fecha Solicitud </th>
					  <th scope='col'>Fecha Inicial</th>
					  <th scope='col'>Fecha Final</th>
					  <th scope='col'>Días</th>
					  <th scope='col'>Tipo</th>
					  <th scope='col'>Estado</th>
					</tr>
				</thead>
				<tbody>
				<?php	
				$arrayLength = count($licencias);
				$i = 0;
				
				while ($i < $arrayLength) {?>
					<tr class="pedidosT__row" onclick="getIndex(this)">	
						<td> <?php echo $licencias[$i]->id;?></td>					
						<td style="min-width: 120px"> <?php echo $licencias[$i]->fecha;?></td>
						<td style="min-width: 120px"> <?php echo $licencias[$i]->fechaini;?></td>
						<td style="min-width: 120px"> <?php echo $licencias[$i]->fechafin;?></td>
						<td> <?php echo $licencias[$i]->dias;?></td>
						<td> <?php echo $licencias[$i]->tipo;?></td>	
						<td> <?php echo $licencias[$i]->estado;?></td>	
						<td><input type="hidden" value="escondido"></td>
					</tr><?php
					$i++;
					}
					 ?>	  
				</tbody>
			</table>
		</div>
 	</div>
 	<div class="item-grid item3">
 		
			
			<?php
			$this->lang->load('calendar_lang', 'spanish');
			echo $this->calendar->generate($year,$month);

			?>
						

 	</div>	
 	<!-- <div class="item-grid item6"></div> -->
 	
 </div>

 <script type = 'text/javascript' src = "<?php echo base_url();?>js/imprimirLicencia.js"></script>