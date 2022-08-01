	
	<div class="container">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i>  CONFECCIONAR ORDEN DE COMPRA: </h3>
		</div>
		
		<form method="POST" action="<?php echo site_url('compras/generar_OC'); ?>">	
			<?php
		echo "<form action='".site_url('compras/anular_pedido')."' method ='POST' id='anular'>
			";
		?>
			<table class='pedidosT'>
				<thead>
					<tr class="pedidosT__encabezado">
						<th class="pedidosT__fecha">#</th>
						<th class="pedidosT__fecha" scope='col'>Fecha </th>
						<th class="pedidosT__usuario" scope='col'>Pedido </th>
						<th class='pedidosTh__select'>Descripción</th>
						<th class='pedidosT__cantidad'>Cantidad</th>
						
					</tr>
				</thead>
				<tbody>
				
				<?php	
				$arrayLength = count($pedidos);
				$i = 0;
				$j = 1;
				
				while ($i < $arrayLength) {

					
						echo "<tr class='pedidosT__row'>";	
							echo "<td><input class='form-check-input' type='checkbox' id='OC_check' name='OC_check[]' value='".$pedidos[$i]->id."'></td>";
							echo "<td class='pedidosT__fecha'> ".$pedidos[$i]->fecha."</td>";			
							echo "<td><input type='hidden' name='pedido[]' value='".$pedidos[$i]->id."'>".$pedidos[$i]->pedido."</td>";
							echo "<td>
									<select class='pedidosT__select' id='iOption' name='articulo[]'>
										<option value='".$pedidos[$i]->idArt."'>".$pedidos[$i]->nombre." ".$pedidos[$i]->marca."</option>";
									if (!empty($pedidos[$j]->id)){
										while ($pedidos[$i]->id == $pedidos[$j]->id) {
											echo "<option value='".$pedidos[$j]->idArt."'> ".$pedidos[$j]->nombre." ".$pedidos[$j]->marca."</option>";
											$i++;
											$j++;
										}
									}
							echo "	</select>
									</td>";
							echo "	<td class='pedidosT__cantidad'> <input class='pedidosT__cantidad' type='number' name='cantidad[]' value='1'></td>";
							echo "							
								</tr>";
						
						$i++;
						$j++;
					}?>	  
				</tbody>
			</table>

			<div class="container_insert">
				  
			  	<div class="container__form">
					<div class="col-md-4">
					  <label for="iArticulo">Proveedor</label>
					  <select class="form__select" id="iProveedor" name="proveedor" >
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
					<div class="form-check">

					</div>
				
					<div class="container__button">
						<input type="submit" class="btn btn-insert" name="boton" value="Generar Orden">
						<input type="submit" class="btn btn-insert" name="boton" value="Anular">
					</div>
				</div>
			</div>
			</form>
		</form>
	</div>
</div>	
<script type = 'text/javascript' src = "<?php echo base_url();?>js/comprasJava.js"></script>
<script type = 'text/javascript' src = "<?php echo base_url();?>js/menuComprasJava.js"></script>