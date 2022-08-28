	<div class="container">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i>  INGRESAR PEDIDO: </h3>
		</div>
		<table class='pedidosT'>
			<thead>
				<tr class="pedidosT__encabezado">
				  <th class="pedidosT__fecha" scope='col'>Número </th>
				  <th scope='col'>Descripción </th>
				  <th scope='col'>Proveedor</th>
				  <th scope='col'>Cantidad</th>
				  <th scope='col' colspan="2">Opciones</th>
				</tr>
			</thead>
			<tbody>
			<?php	
			$arrayLength = count($pedidos);
			$i = 0;
			
			while ($i < $arrayLength) {?>
				<tr class="pedidosT__row">						
					<td class="pedidosT__fecha"> <?php echo $pedidos[$i]->numero;?></td>
					<td> <?php echo $pedidos[$i]->descripcion."-";?></td>
					<td> <input type="hidden" form="edit<?php echo $pedidos[$i]->id?>" type="text" name="OC" value="<?php echo $pedidos[$i]->id;?>">
						<select class="form-control" id="iproveedor" name="iproveedor" form="edit<?php echo $pedidos[$i]->id?>">
							<option value="<?php echo $pedidos[$i]->proveedor;?>"><?php echo $pedidos[$i]->nombre;?></option>
						<?php
						  	$provLength = count($proveedores);
							$j = 0;
							while ($j < $provLength) {?>
								<option value='<?php echo $proveedores[$j]->id;?>'><?php echo $proveedores[$j]->nombre;?></option>
						 	<?php
							$j++;
							}
						?>	
						</select>  

						</td>
					<td> <input class="form-control" type="number" min="1" form="edit<?php echo $pedidos[$i]->id?>" name="cantidad" value="<?php echo $pedidos[$i]->cantidad;?>" style="width: 50px;"></td>
					<td>
						<form action="<?php echo site_url('compras/editarOC/edit'); ?>" id='edit<?php echo $pedidos[$i]->id?>' method ='POST'>
							
							<button type='submit' class='btn btn-delete'>Editar</button>
						</form>
					</td>
					<td>
						<form action="<?php echo site_url('compras/editarOC/anular'); ?>" method ='POST'>	
							<input type="hidden" name="OC" value="<?= $pedidos[$i]->id?>">
							<input type="hidden" name="pedido" value="<?= $pedidos[$i]->pedido?>">
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
<script type = 'text/javascript' src = "<?php echo base_url();?>js/comprasJava.js"></script>
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuComprasJava.js"></script>