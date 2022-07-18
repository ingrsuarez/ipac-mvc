
		<!-- <div class="container"> -->
			<div class="board">	 
				<table class='board__table'>
					<thead>

					</thead>
					<tbody>
					<?php	
					$arrayLength = count($board);
					$i = 0;
					// var_dump($board);
					while ($i < $arrayLength) {?>
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
						$i++;
						}
						 ?>	  
					</tbody>
				</table>
			</div>
		</div>
