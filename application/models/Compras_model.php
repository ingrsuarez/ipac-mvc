<?php 


class Compras_model extends CI_Model {

	public $usrId = "";
	const vpedidos_table = "vpedidos";

	public function __constructor ($id=""){

		$this->usrId = $id;
		$this->load->database();
		
	}


	public function get_pedidos($filter='', $param='')
	{
		//Return pedidos table notes
		$sql = "SELECT * FROM ".self::vpedidos_table." ORDER BY estado DESC, fecha DESC ";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;

	}


}

?>