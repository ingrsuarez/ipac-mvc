	<div class="container">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i>  INGRESAR PEDIDO: </h3>
		</div>
		<?php
			 

		?>	
		
		<div class="container_table">
			<form method="POST">
					  
			  <div class="container__table">
				<div class="col-md-4">
				  <label for="iArticulo">Articulo</label>
				  <input type="text" class="form-control" id="iArticulo" name="iArticulo">
				</div>
				<div class="col-md-3">
				  <label for="iSector">Sector</label>
				  <select class="form-control" id="iSector" name="iSector" >
					
					<option value='7' selected>Quimica</option>
					<option value='8'>Hematologia</option>
					<option value='6'>Hormonas</option>
					<option value='12'>Serologia</option>
					<option value='13'>Bacteriologia</option>
					<option value='14'>Toxicologia</option>
					<option value='11'>Sala Extraccion</option>
					<option value='14'>Aguas</option>
					<option value='15'>Veterinaria</option>
					<option value='3'>Mantenimiento</option>
					<option value='3'>Limpieza</option>
					<option value='4'>Secretaria</option>
						
				  </select>
					</div>
					
				  </div>
				  <div class="form-group">
					<div class="form-check">
					  <input class="form-check-input" type="checkbox" id="iCheck" name="iCheck">
					  <label class="form-check-label" for="gridCheck">
						Pedir
					  </label>
					</div>
				  </div>
				  <button type="submit" class="btn btn-insert">Ingresar Pedido</button>
			</form>
		</div>
	</div>
</div>	