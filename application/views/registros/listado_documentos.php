	<div class="container">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i>  Listado de documentos: </h3>
		</div>
		
		<form method="POST">
		<table class='dataTable'>
			<thead>
				<tr class="dataTable__encabezado">
					<th scope="col">#</th>
				 	<th class="dataTable__fecha" scope='col'>Fecha </th>
				  	<th scope='col'>Nombre</th>
				  	<th scope='col'>Revisión</th>
				  	<th scope='col'>Proceso</th>
				  	<th scope='col'>Próxima revisión</th>
				</tr>
			</thead>
			<tbody>
			<?php	
			$arrayLength = count($listado);
			$i = 0;
			
			while ($i < $arrayLength) {?>
				<tr class="dataTable__row" onclick="getIndex(this)">	
					<td> <?php echo $listado[$i]->id?></td>					
					<td class="dataTable__fecha"> <?php echo $listado[$i]->fecha;?></td>
					<td> <?php echo $listado[$i]->nombre."-";?></td>
					<td> <?php echo $listado[$i]->revision;?></td>
					<td><input type="hidden" id='proceso' name = 'proceso' value='<?php echo $listado[$i]->proceso?>'> <?php echo $listado[$i]->proceso."/".$listado[$i]->sector;?></td>
					<td> <?php echo $listado[$i]->duracion;?></td>						
				</tr><?php
				$i++;
				}
				 ?>	  
			</tbody>
		</table>
	</form>	


	</div>

	<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuRegistrosJava.js"></script>
	<script type = 'text/javascript' src = "<?php echo base_url();?>js/registros.js"></script>