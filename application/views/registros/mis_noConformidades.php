
	<div class="container">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i> MIS NO CONFORMIDADES: </h3>
		</div>
		<form method="POST" id = "global" action="<?php echo site_url('registros/editar_noConformidad'); ?>">
			<div class="container_insert">	  
				<div class="container__form">
					<div class="col-md-4">
						<label for="iestado">Tipo:</label>
						<select class="form-control" id="tipo" name="tipo" >
							<option value="">Seleccione tipo......</option>
							<option value='NO SE SIGUE EL PROCEDIMIENTO'> NO SE SIGUE EL PROCEDIMIENTO </option>
							<option value='ERROR DE INGRESO'> ERROR DE INGRESO </option>
							<option value='TAREAS SIN REALIZAR'> TAREAS SIN REALIZAR </option>
							<option value='NO SE CONOCE EL PROCEDIMIENTO'> NO SE CONOCE EL PROCEDIMIENTO </option>
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
				
		</form> 
	</div>	 
<!-- <script type = 'text/javascript' src = "<?php echo base_url();?>js/comprasJava.js"></script> -->
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuRegistrosJava.js"></script>