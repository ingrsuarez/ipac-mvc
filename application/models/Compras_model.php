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
		//Return pedidos table notes
		 // "SELECT * FROM ".self::vpedidos_table." WHERE estado = 'pendiente' ORDER BY fecha DESC";
		 $sql = "SELECT vpedidos.id, vpedidos.fecha, vpedidos.articulo AS pedido, articulos.nombre, articulos.id AS idArt, articulos.marca FROM `articulos` INNER JOIN vpedidos ON articulos.nombre LIKE CONCAT('%',SUBSTRING(vpedidos.articulo,1,5),'%') WHERE vpedidos.estado = 'pendiente' ORDER BY vpedidos.articulo";
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

	public function list_proveedores($value='')
	{
		$sql = "SELECT * FROM ".self::proveedores_table." ORDER BY peso DESC, nombre ASC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

}

?>