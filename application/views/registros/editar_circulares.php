	<div class="container">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i>  EDITAR CIRCULARES: </h3>
		</div>
		<table class='pedidosT'>
			<thead>
				<tr class="pedidosT__encabezado">
				  <th class="pedidosT__fecha" scope='col'>Fecha </th>
				  <th class="pedidosT__usuario" scope='col'>Creador <input class="form-check-input" type="checkbox" id="userCheck" name="userCheck"></th>
				  <th scope='col'>Título</th>
				  <th scope='col' colspan="3">Estado</th>
				</tr>
			</thead>
			<tbody>
			<?php	
			$arrayLength = count($circulares);
			$i = 0;
			
			while ($i < $arrayLength) {?>
				<tr class="pedidosT__row">						
					<td class="pedidosT__fecha"> <?php echo $circulares[$i]->fecha;?></td>
					<td> <?php echo $circulares[$i]->nombre."-";?></td>
					<td> <?php echo $circulares[$i]->titulo;?></td>
					<td> <?php echo $circulares[$i]->estado;?></td>
					<td>
						<form action="<?php echo site_url('registros/activar_circular'); ?>" id='edit<?php echo$i?>' method ='POST'>
							<input type="hidden" name="circularActivar" value="<?= $circulares[$i]->id?>">
							<button type='submit' class='btn btn-delete' name='edit'>Activar</button>
						</form>
					</td>
					<td>
						<form action="<?php echo site_url('registros/anular_circular'); ?>" method ='POST' name="anular">	
							<input type="hidden" name="delete" for="anular" value="<?= $circulares[$i]->id?>">
							<button type='submit' class='btn btn-delete'>Anular</button>
						</form>
					</td>						
				</tr><?php
				$i++;
				}
				 ?>	  
			</tbody>
		</table>
		
		<div class="container_insert">
			<form method="POST" action="<?php echo site_url('compras/insertar_pedido'); ?>">	  
			  	<div class="container__form">
					<div class="col-md-4">
					  <label for="iArticulo">Articulo</label>
					  <input type="text" class="form-control" id="articulo_pedido" name="articulo_pedido" autofocus>
					
					  <label for="iSector">Sector</label>
					  <select class="form-control" id="iSector" name="sector" >
						
						<option value='7' selected>Quimica</option>
						<option value='8'>Hematologia</option>
						<option value='6'>Hormonas</option>
						<option value='12'>Serologia</option>
						<option value='13'>Bacteriologia</option>
						<option value='14'>Toxicologia</option>
						<option value='11'>Sala Extraccion</option>
						<option value='16'>Aguas</option>
						<option value='15'>Veterinaria</option>
						<option value='3'>Mantenimiento</option>
						<option value='3'>Limpieza</option>
						<option value='4'>Secretaria</option>
							
					  </select>
					</div>
					
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="iCheck" name="iCheck">
					<label class="form-check-label" for="gridCheck">
					Pedir
					</label>
				</div>

				<button type="submit" class="btn btn-insert">Ingresar Pedido</button>
			</form>
		</div>
	</div>
</div>	
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuRegistrosJava.js"></script>