<?php 


class Compras_model extends CI_Model {

	public $usrId = "";
	const vpedidos_table = "vpedidos";
	const pedidos_table = "pedidos";

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

	public function editar_pedidos($user='')
	{
		//Return pedidos table notes
		$sql = "SELECT * FROM ".self::vpedidos_table." WHERE estado = 'pendiente' ORDER BY fecha DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;

	}

	public function editar_pedido($action='', $id='')
	{
		//Delet pedidos row
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
		// $this->db->where('id', $id);
		// $this->db->update(self::board_table,$row);
			
	}


}

?>