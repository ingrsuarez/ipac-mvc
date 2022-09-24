<?php 


class Registros_model extends CI_Model {

	public $usrId = "";
	const circulares_table = "circulares";
	const vcirculares_table = "vcirculares";
	const sector_table = "sector";
	const procesos_table = "documentos";



	public function __constructor ($id=""){

		$this->usrId = $id;
		$this->load->database();
		
	}

	public function insert_circular($array)
	{
		$this->db->insert(self::circulares_table,$array); 		
	}

	public function list_sectores($value='')
	{
		$sql = "SELECT * FROM ".self::sector_table." ORDER BY nombre ASC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function list_procesos($value='')
	{
		$sql = "SELECT * FROM ".self::procesos_table." ORDER BY nombre ASC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function list_circulares($value='')
	{
		$sql = "SELECT * FROM ".self::circulares_table." WHERE estado = '".$value."' ORDER BY fecha DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function list_vcirculares($value='')
	{
		$sql = "SELECT * FROM ".self::vcirculares_table." ORDER BY fecha DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function get_circular($idCircular="")
	{
		if (!empty($idCircular))
		{
			$sql = "SELECT * FROM `vcircularesabiertas` WHERE `id` = '".$idCircular."'";
			$query = $this->db->query($sql);
			$result = $query->result_array();
			return $result;
		}

	}

	public function activar_circular($idCircular="")
	{
		if (!empty($idCircular))
		{
			$sql = "UPDATE `circulares` SET `estado`='activa' WHERE id = '".$idCircular."'";
			$query = $this->db->query($sql);

		}

	}

	public function anular_circular($idCircular="")
	{
		if (!empty($idCircular))
		{
			$sql = "UPDATE `circulares` SET `estado`='caducada' WHERE id = '".$idCircular."'";
			$query = $this->db->query($sql);

		}

	}



	

		
}

?>