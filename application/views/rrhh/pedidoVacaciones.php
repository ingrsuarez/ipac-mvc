<?php
	// require($_SERVER['DOCUMENT_ROOT'].'/IpacGestion/includes/functionRrhh.php');
	// require ('../../includes/cn.php');

	// if (array_key_exists('button_logout',$_POST)) {
	// 	echo "destroy log: ".$_POST['button_logout'];
	// 	session_destroy();
	// 	header("location: ".$_SERVER['DOCUMENT_ROOT']."/IpacGestion/index.php");
	// }
	// // Chequeo que halla un POST
	// if (!empty($_POST)){
	// 	// Chequeo que se ingresaron ambas fechas
	// 	if (!empty($_POST['fechai']) && !empty($_POST['fechafin'])){
	// 		// Chequeo que hay sesion iniciada
	// 		if (!empty($_SESSION['uid'])){
	// 			$empleado = $_SESSION['uid'];
	// 			$diasDisponibles = sVacaciones($empleado);
	// 			// Chequeo que tenga días disponibles
	// 			if ($diasDisponibles > 0){
	// 				$fechai = $_POST['fechai'];
	// 				$fechafin = $_POST['fechafin'];
	// 				$date1 = new DateTime($fechai);
	// 				$date2 = new DateTime($fechafin);
	// 				$hoy = new DateTime('now');
	// 				$ahora = date("Y-m-d H:i:s");
	// 				$year = date("Y");
	// 				//Chequeo que la fecha inicial sea >= a hoy
	// 				if ($date1 >= $hoy){
	// 					//Chequeo que la fecha final sea >= que la fecha de inicio
	// 					if ($date2 >= $date1) {
	// 						$diasApedir  = ($date2->diff($date1)->format('%a'))+1;
	// 						if ($diasDisponibles >= $diasApedir){
	// 							$query = "INSERT INTO `licencias` (`fecha`, `empleado`, `tipo`, `descripcion`, `fechaini`, `fechafin`, `justificado`, `medico`, `horas50`, `horas100`, `supervisor`, `mes`, `estado`) VALUES ('".$ahora."', '".$empleado."', 'vacaciones', '', '".$fechai."', '".$fechafin."', 'si', 'NA', '0', '0', '1', '', 'revision')";		
	// 							mysqli_query($enlace, $query);
	// 						}else {echo "<script>alert('No tiene suficientes días disponibles!')</script>";}
	// 					}else {echo "<script>alert('La fecha final debe ser mayor a la fecha inicial!')</script>";}
	// 				}else{echo "<script>alert('Elija una fecha mayor a hoy!')</script>";}
	// 			} else {echo "<script>alert('No días disponibles!')</script>";}
	// 		}
	// 	} else {
	// 		echo "<script>alert('Por favor complete ambas fechas!')</script>";
	// 	}

	// }


?>
 

		
	
		<form method="POST" id="ingresoVacaciones">
			<div class="container">
				<h3><i class="fas fa-suitcase"></i>VACACIONES</h3>
				<div class="input-group">
					<div class="input-group-prepend">
						<label class="input-group-text" for="fechai">Días disponibles: </label>
					</div>
					<p class="input-group-text" text-align="right"><?php echo $vacaciones;?></p>
				</div>	
			
				<div class="input-group">
					<div class="row">
						<div class="col">
							<div class="input-group-prepend">
								<label class="input-group-text" for="fechai">Fecha inicial: </label>
							</div>
							<input type="date" class="custom-control-input" id="fechai" name="fechai">	
						</div>
						<div class="col">
							<div class="input-group-prepend">
								<label class="input-group-text" for="fechai">Fecha final: </label>
							</div>
							<input type="date" class="custom-control-input" id="fechafin" name="fechafin">	
						</div>
						<script type="text/javascript">
							$(document).ready(function(){
								$("#fechai").change(function(){
									var diasd = 0;


								})


							});

						</script>
					</div>	
				</div>
				<div class="row">
					<div class="col">
						<button type="submit" class="btn btn-primary" name="registrar">Registrar</button>	
					</div>
				</div>
			</div>			
		</form>	

	
