<?php 


class Compras_model extends CI_Model {

	public $usrId = "";
	const vpedidos_table = "vpedidos";
	const pedidos_table = "pedidos";
	const proveedores_table = "proveedores";
	const stock_table = "stock";

	public function __constructor ($id=""){

		$this->usrId = $id;
		$this->load->database();
		
	}


	public function get_pedidos($filter='', $param='')
	{
		//Return pedidos table notes
		$sql = "SELECT * FROM ".self::vpedidos_table." ORDER BY estado DESC, fecha DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;

	}

	public function get_mispedidos($user='')
	{
		//Return pedidos table notes
		$sql = "SELECT * FROM ".self::vpedidos_table." WHERE usuario = '".$user."' ORDER BY estado DESC, fecha DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;

	}

	public function pedidos_pendientes($item='')
	{
		//Return pedidos table notes
		if (empty($item))
		{
			$sql = "SELECT * FROM ".self::vpedidos_table." WHERE estado = 'pendiente' ORDER BY fecha DESC";
			$query = $this->db->query($sql);
			$result = $query->result();
			return $result;	
		}else
		{
			$sql = "SELECT * FROM ".self::vpedidos_table." WHERE estado = 'pendiente' AND articulo LIKE ".$item." ORDER BY fecha DESC";
			$query = $this->db->query($sql);
			$result = $query->result();
			return $result;	
		}

		

	}

	public function pedidos_equivalentes($user='')
	{
		
		//This query translate the user request to supplier items options
		$sql = "SELECT vpedidos.id, vpedidos.fecha, vpedidos.articulo AS pedido, articulos.nombre, articulos.id AS idArt, articulos.marca FROM `articulos` INNER JOIN vpedidos ON articulos.nombre LIKE CONCAT('%',SUBSTRING_INDEX(vpedidos.articulo,' ',1),'%') OR articulos.alt LIKE CONCAT('%',SUBSTRING_INDEX(vpedidos.articulo,' ',1),'%') WHERE vpedidos.estado = 'pendiente' ORDER BY vpedidos.articulo";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function editar_pedido($item='', $id='')
	{
		//Edit pedidos row
		$sql = "UPDATE `pedidos` SET `articulo`='".$item."',`fechap`='hoy' WHERE id = ".$id;
		$query = $this->db->query($sql);		

	}

	public function anular_pedido($action='', $id='')
	{
		//Delete pedidos row
		$sql = "UPDATE `pedidos` SET `estado`='".$action."',`fechap`='hoy' WHERE id = ".$id;
		$query = $this->db->query($sql);		

	}


	public function insert_pedido($array)
	{
		
		$userId = $this->session->userdata('id');
        $today = date("Y-m-d H:i:s");
		$row = array('fecha' => $today,
					 'solicita' => $array['id'], 
					 'articulo' => $array['articulo'], 
					 'estado' => 'pendiente', 
					 'sector' => $array['sector']);
		
		$this->db->insert(self::pedidos_table,$row); 

			
	}

	public function insert_OC($array)
	{
		$user = $this->session->userdata('id');
		$qregistro = "INSERT INTO ordencompra (numero,fecha,articulo,pedido,cantidad,proveedor,codprov,estatus,creador,descripcion)	VALUES ('".$array['numero']."','".$array['fecha']."','".$array['articulo']."','".$array['pedido']."','".$array['cantidad']."','".$array['proveedor']."','','creada','".$user."','".$array['descripcion']."')";
		$query = $this->db->query($qregistro);	
		$updatep = "UPDATE `pedidos` SET `estado` = 'pedido', `fechap` = '".$array['fecha']."' WHERE `pedidos`.`id` = '".$array['pedido']."'";
		
		$query = $this->db->query($updatep);

	}

	public function list_proveedores($value='')
	{
		$sql = "SELECT * FROM ".self::proveedores_table." ORDER BY peso DESC, nombre ASC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function select_proveedor($value='')
	{
		$sql = "SELECT * FROM ".self::proveedores_table." WHERE id = ".$value;
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result[0];
	}

	public function nombre_articulo($id)
	{
		$sql = "SELECT nombre FROM `articulos` WHERE `id` = '".$id."'";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		return $result;
	}

	public function esta_pedido($idArt='',$proveedor='')
	{
		$sql = "SELECT SUM(cantidad) as cantidad, descripcion, COUNT(*) from ordencompra WHERE proveedor = ".$proveedor." AND articulo = ".$idArt." AND (estatus = 'creada' OR estatus = 'enviada') GROUP BY descripcion";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		return $result;		
	}




	public function oc_pendientes($idProveedor="1")
	{
		if (!empty($idProveedor))
		{
			$sql = "SELECT * FROM `ocpendientes` WHERE proveedor = '".$idProveedor."' ORDER BY `numero`";
			$query = $this->db->query($sql);
			$result = $query->result();
			
			return $result;
		}else
		{
			$sql = "SELECT * FROM `ocpendientes` WHERE proveedor = '1' ORDER BY `numero`";
			$query = $this->db->query($sql);
			$result = $query->result();
			
			return $result;
		}
		 

	}

	public function pendientes_proveedor($idProveedor="1")
	{
		if (!empty($idProveedor))
		{
			$sql = "SELECT * FROM `vrecibir` WHERE pid = '".$idProveedor."' ORDER BY `numero`";
			$query = $this->db->query($sql);
			$result = $query->result();
			
			return $result;
		}else
		{
			$sql = "SELECT * FROM `ocpendientes` WHERE proveedor = '1' ORDER BY `numero`";
			$query = $this->db->query($sql);
			$result = $query->result();
			
			return $result;
		}
		 

	}

	public function oc_items($number) {
		// $sql = "SELECT * from ocpendientes WHERE numero = ".$number;
		$sql = "SELECT * FROM `vocimprimir` WHERE `numero` = '".$number."'";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
	}

	public function recibir_OC($OCid,$recibido,$userId,$articulo,$pedido,$lote,$vencimiento,$proveedor,$remito,$fecha)
	{
		if (!empty($OCid))
		{
			foreach ($OCid as $key => $id)
			{
				$sql = "SELECT cantidad FROM `ordencompra` WHERE `id` = ".$id;
				$query = $this->db->query($sql);
				$result = $query->result_array();
				$cantidad = $result[0]['cantidad'];
				$today = $fecha;
				
				if ($cantidad == $recibido[$key] )
				{
					$updateOC = "UPDATE `ordencompra` SET `estatus` = 'recibido', `recibe` = '".$userId."', `cantidad` = '0' WHERE `ordencompra`.`id` = '".$id."'";
					$query = $this->db->query($updateOC);
					// INSERT INTO `stock` (`id`, `fecha`, `articulo`, `cantidad`, `lote`, `vencimiento`, `deposito`, `ubicacion`, `movimiento`, `usuario`, `precio`, `proveedor`, `remito`, `factura`) VALUES (NULL, '2022-08-24', '160', '2', '333', '2022-08-31', '0', 'Leguizamon 356', 'ingreso', '1', '0', '1', '0002-00000123', '00000-00000000');
					$row = array('fecha' => $today,
						'articulo' => $articulo[$key], 
						'cantidad' => $recibido[$key], 
						'lote' => $lote[$key], 
						'vencimiento' => $vencimiento[$key],
						'movimiento' => 'ingreso',
						'usuario' => $userId,
						'proveedor' => $proveedor,
						'remito' => $remito);
					$this->db->insert(self::stock_table,$row); 
					$updateP = "UPDATE pedidos SET estado = 'recibido' WHERE id = ".$pedido[$key];
					$query = $this->db->query($updateP);

				}elseif ($cantidad > $recibido[$key])
				{
					//UPDATE ORDEN DE COMPRA	
					$pendiente = intval($cantidad) - intval($recibido[$key]);
					$updateOC = "UPDATE `ordencompra` SET `cantidad` = '".($pendiente)."', `recibe` = '".$userId."' WHERE `ordencompra`.`id` = '".$id."'";
					$query = $this->db->query($updateOC);
					// UPDATE STOCK
					$row = array('fecha' => $today,
						'articulo' => $articulo[$key], 
						'cantidad' => $recibido[$key], 
						'lote' => $lote[$key], 
						'vencimiento' => $vencimiento[$key],
						'movimiento' => 'ingreso',
						'usuario' => $userId,
						'proveedor' => $proveedor,
						'remito' => $remito);
					$this->db->insert(self::stock_table,$row); 
					$updateP = "UPDATE pedidos SET estado = 'recibido' WHERE id = ".$pedido[$key];
					$query = $this->db->query($updateP);

				}
			}

		}



	}
		
}

?>