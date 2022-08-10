<?php
	
	if (!empty($_POST['iproveedor'])){
		$idProveedor = $_POST['iproveedor'];
		$enlace = new mysqli("127.0.0.1", "u540644031_suarroda", "Ipac2021", "u540644031_GestionIpac", 3306);	 
		$query = "SELECT * FROM `ocpendientes` WHERE proveedor = '".$idProveedor."' ORDER BY `numero`";
		$resultado = mysqli_query($enlace,$query);			 
		$cont = 0; 
		$data = array();
		while ($row = mysqli_fetch_assoc($resultado)) {
			$data[$cont] = $row;
			$cont++;
		}
		echo (json_encode($data));
	}

?>