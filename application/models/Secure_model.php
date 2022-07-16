<?php 


class Secure_model extends CI_Model {


	public function __constructor (){

		
		$this->load->database();
		
	}


	public function check_password($data)
	{
		$userName = $data['userName'];
		$password = $data['password'];
		$sql = "SELECT * FROM empleados WHERE usuario = '".$userName."' AND clave = '".$password."' LIMIT 1";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		return $result;

	}



}
