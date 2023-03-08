<?php 


class Compras_model extends CI_Model {

	public $usrId = "";
	const vpedidos_table = "vpedidos";
	const pedidos_table = "pedidos";
	const proveedores_table = "proveedores";
	const stock_table = "stock";
	const articulos_table = "articulos";

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

	public function updatePesoProveedor($id)
    {
        
        $sql = "SELECT * FROM ".self::proveedores_table." WHERE id = ".$id;
        $query = $this->db->query($sql);
        $result = $query->row();
        $peso = $result->peso;
        if ($peso < 100)
        {
            $query = $this->db->query("UPDATE ".self::proveedores_table." SET proveedores.peso = proveedores.peso + 1 WHERE proveedores.id = ".$id);
        }else
        {
            $query = $this->db->query("UPDATE ".self::proveedores_table." SET proveedores.peso = proveedores.peso - 1 WHERE proveedores.peso > 0 AND proveedores.id <> ".$id);
        }

    }

	public function list_proveedores($value='')
	{
		$sql = "SELECT * FROM ".self::proveedores_table." ORDER BY peso DESC, nombre ASC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function list_sector($value='')
	{
		$sql = "SELECT id, nombre FROM `sector` ORDER BY nombre";
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

	public function numero_remito($numero="")
	{
	if (!empty($numero))
		{
			$sql = "SELECT * FROM `vremitos` WHERE vremitos.remito LIKE '%".$numero."%' ORDER BY `fecha` DESC LIMIT 25";
			$query = $this->db->query($sql);
			$result = $query->result();
			
			return $result;
		}


	}

	public function proveedor_remito($proveedor="")
	{
	if (!empty($proveedor))
		{
			$sql = "SELECT * FROM `vremitos` WHERE vremitos.proveedor LIKE '%".$proveedor."%' ORDER BY `fecha` DESC LIMIT 25";
			$query = $this->db->query($sql);
			$result = $query->result();
			
			return $result;
		}


	}

	public function articulo_remito($articulo="")
	{
	if (!empty($articulo))
		{
			$sql = "SELECT * FROM `vremitos` WHERE vremitos.articulo LIKE '%".$articulo."%' ORDER BY `fecha` DESC LIMIT 25";
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

	// OC PENDIENTES
	public function OC_itemsPendientes()
	{

		$sql = "SELECT * FROM `vocimprimir` ORDER BY id";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;



	}

	public function edit_OC($id='',$idProveedor='',$cantidad='',$numero='')
	{
		$updateP = "UPDATE ordencompra SET numero = '".$numero."', proveedor = '".$idProveedor."', cantidad = '".$cantidad."', estatus = 'creada' WHERE id = ".$id;
		$query = $this->db->query($updateP);

	}

	public function anular_OC($id='',$pedido='')
	{
		$updateOC = "UPDATE ordencompra SET estatus = 'anulada' WHERE id = ".$id;
		$query = $this->db->query($updateOC);
		$updateP = "UPDATE pedidos SET estado = 'anulado' WHERE id = ".$pedido;
		$query = $this->db->query($updateP);

	}

	public function buscar_articulo($nombre)
	{
		$sql = "SELECT articulos.id, articulos.nombre, articulos.marca, SUM(stock.cantidad) as cantidad FROM articulos INNER JOIN stock ON stock.articulo = articulos.id WHERE articulos.nombre LIKE '".$nombre."%' OR articulos.alt LIKE '".$nombre."%' GROUP BY articulos.nombre ORDER BY articulos.nombre LIMIT 15";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function brand_articulo($marca)//SEARCH BY BRAND
	{
		$sql = "SELECT articulos.id, articulos.nombre, articulos.marca, SUM(stock.cantidad) as cantidad FROM articulos INNER JOIN stock ON stock.articulo = articulos.id WHERE articulos.marca LIKE '".$marca."%' GROUP BY articulos.nombre ORDER BY articulos.nombre";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function nuevo_articulo($articulo)
	{
				
		$this->db->insert(self::articulos_table,$articulo); 

		
		$userId = $this->session->userdata('id');
		$sql = "SELECT MAX(id) FROM articulos";
		$query = $this->db->query($sql);
		$lastId = $query->result();
		$row = array('fecha' => $articulo['fechain'],
						'articulo' => $lastId[0]->{'MAX(id)'}, 
						'cantidad' => '0', 
						'lote' => '', 
						'vencimiento' => '',
						'movimiento' => 'ingreso',
						'usuario' => $userId,
						'proveedor' => '',
						'remito' => '');
		$this->db->insert(self::stock_table,$row);
	}

	public function descargar_articulo($articulo,$cantidad)
	{
		$userId = $this->session->userdata('id');
        $today = date("Y-m-d H:i:s");
        
		$row = array('fecha' => $today,
					 'articulo' => $articulo, 
					 'cantidad' => "-".$cantidad, 
					 'lote' => '',
					 'vencimiento' => '',
					 'deposito' => '',
					 'ubicacion' => '0',
					 'movimiento' => 'baja',
					 'usuario' => $userId);
		
		$this->db->insert(self::stock_table,$row); 


	}

		
}

?>