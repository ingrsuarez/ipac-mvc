<?php 


class Novedades_model extends CI_Model {

	public $usrId = "";
	const vboard_table = "vpizarra";
	const board_table = "pizarra";

	public function __constructor ($id){

		$this->usrId = $id;
		$this->load->database();
		
	}


	public function get_board($filter='', $param='')
	{
		//Returns board table notes
		$sql = "SELECT * FROM ".self::vboard_table;
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;

	}

	public function set_board($id,$param,$value)
	{
		$userId = $this->session->userdata('id');
		$today = date("Y-m-d H:i:s");
		$row = array(
			"id" => $id,
			"fechar" => $today,
			"usuarior" => $userId,
			$param => $value);
	
		$this->db->where('id', $id);
		$this->db->update(self::board_table,$row);
			
	}

	public function insert_board($value,$sector)
	{
		
		$userId = $this->session->userdata('id');
        $today = date("Y-m-d H:i:s");
		$row = array('fecha' => $today, 'nota' => $value, 'usuario' => $userId, 'sector' => $sector, 'estado' => 'pendiente');
		
		$this->db->insert(self::board_table,$row); 
		// $this->db->where('id', $id);
		// $this->db->update(self::board_table,$row);
			
	}
}
















 ?>