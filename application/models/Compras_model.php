<?php 


class Compras_model extends CI_Model {

	public $usrId = "";
	const vpedidos_table = "vpedidos";
	const pedidos_table = "pedidos";
	const proveedores_table = "proveedores";

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

	public function pedidos_pendientes($user='')
	{
		//Return pedidos table notes
		$sql = "SELECT * FROM ".self::vpedidos_table." WHERE estado = 'pendiente' ORDER BY fecha DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;

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
		
}

?>