
		<!-- <div class="container"> -->
			<div class="container">	
				<div class="flow_column">
				<!-- Nav tabs -->
					<ul class="menu__item" role="tablist">
						<li class="tab__item">
						  <a class="tab-link active" data-toggle="tab" id="general_link" href="#general">General</a>
						</li>
						<li class="tab__item">
						  <a class="tab-link" data-toggle="tab" id="ordenes_link" href="#ordenes">Ordenes</a>
						</li>
						<li class="tab__item">
						  <a class="tab-link" data-toggle="tab" id="analitica_link" href="#analitica">Analítica</a>
						</li>
					</ul>
				</div> 
				<div class="board active" id="general">
					<table class='board__table'>
						<thead>

						</thead>
						<tbody>
						<?php	
						$arrayLength = count($board);
						$i = 0;
						// var_dump($board);
						while ($i < $arrayLength) {
							if (empty($board[$i]->sector)){?>
							<tr class="board__row">
								<th scope='row'>
									<label class='custom-control-label' for='tableDefaultCheck2'></label>
								</th>						
								<td style = 'font-size: 12px; width: 100px'><?php echo $board[$i]->fecha;?></td>
								<td> <?php echo $board[$i]->nota."-";?></td>
								<td style='padding-left: 1em'> <?php echo $board[$i]->usuario;?></td>
								<td style='padding-left: 1em'>
									<form action="<?php echo site_url('pages/verify_task'); ?>" method ='POST'>
										<input type="hidden" name="vid" value="<?= $board[$i]->id?>">
										<button type='submit' class='btn btn-verify' name='Verificar'>Verificar</button>
									</form>
								</td>						
							</tr><?php
								}
							$i++;
							}
							 ?>	  
						</tbody>
					</table>
				</div>
				<div class="board fade" id="ordenes">
					<table class='board__table'>
						<thead>

						</thead>
						<tbody>
						<?php	
						$arrayLength = count($board);
						$i = 0;
						// var_dump($board);
						while ($i < $arrayLength) {
							if ($board[$i]->sector == 4){?>
							<tr class="board__row">
								<th scope='row'>
									<label class='custom-control-label' for='tableDefaultCheck2'></label>
								</th>						
								<td style = 'font-size: 12px; width: 100px'><?php echo $board[$i]->fecha;?></td>
								<td> <?php echo $board[$i]->nota."-";?></td>
								<td style='padding-left: 1em'> <?php echo $board[$i]->usuario;?></td>
								<td style='padding-left: 1em'>
									<form action="<?php echo site_url('pages/verify_task'); ?>" method ='POST'>
										<input type="hidden" name="vid" value="<?= $board[$i]->id?>">
										<button type='submit' class='btn btn-verify' name='Verificar'>Verificar</button>
									</form>
								</td>						
							</tr><?php
								}
							$i++;
							}
							 ?>	  
						</tbody>
					</table>
				</div>
				<div class="board fade" id="analitica">
					<table class='board__table'>
						<thead>

						</thead>
						<tbody>
						<?php	
						$arrayLength = count($board);
						$i = 0;
						// var_dump($board);
						while ($i < $arrayLength) {
							if ($board[$i]->sector == 5){?>
							<tr class="board__row">
								<th scope='row'>
									<label class='custom-control-label' for='tableDefaultCheck2'></label>
								</th>						
								<td style = 'font-size: 12px; width: 100px'><?php echo $board[$i]->fecha;?></td>
								<td> <?php echo $board[$i]->nota."-";?></td>
								<td style='padding-left: 1em'> <?php echo $board[$i]->usuario;?></td>
								<td style='padding-left: 1em'>
									<form action="<?php echo site_url('pages/verify_task'); ?>" method ='POST'>
										<input type="hidden" name="vid" value="<?= $board[$i]->id?>">
										<button type='submit' class='btn btn-verify' name='Verificar'>Verificar</button>
									</form>
								</td>						
							</tr><?php
								}
							$i++;
							}
							 ?>	  
						</tbody>
					</table>
				</div>	
			</div>
		</div>
		<script type = 'text/javascript' src = "<?php echo base_url();?>js/codigoJava.js"></script>
		<script type = 'text/javascript' src = "<?php echo base_url();?>js/pizarra.js"></script>
