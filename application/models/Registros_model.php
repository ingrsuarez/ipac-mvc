<?php 


class Registros_model extends CI_Model {

	public $usrId = "";
	const circulares_table = "circulares";
	const vcirculares_table = "vcirculares";
	const noConformidades_table = "ncregistros";
	const sector_table = "sector";
	const procesos_table = "procesos";
	const activos_table = "activos";
	const orden_trabajo_table = "ordentrabajo";
	const vorden_trabajo_table = "votabiertas";


	public function __constructor ($id=""){

		$this->usrId = $id;
		$this->load->database();
		
	}

	public function insert_circular($array)
	{
		$this->db->insert(self::circulares_table,$array); 		
	}

	public function insert_noConformidad($array)
	{
		$this->db->insert(self::noConformidades_table,$array); 		
	}

	public function insert_orden_trabajo($array)
	{
		$this->db->insert(self::orden_trabajo_table,$array); 		
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
		$sql = "SELECT * FROM ".self::procesos_table." ORDER BY numero ASC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function list_activos($value='')
	{
		$sql = "SELECT * FROM ".self::activos_table." ORDER BY prioridad DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function list_ordenes_trabajo($value="")
	{
		$sql = "SELECT * FROM ".self::vorden_trabajo_table." ORDER BY fecha DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;

	}

	public function list_ordenes_trabajo_Xequipo($name="")
	{
		$sql = "SELECT * FROM ".self::vorden_trabajo_table." WHERE equipo LIKE '%".$name."%' ORDER BY fecha DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;

	}

	public function noConformidades_abiertas($value='')
	{
		$sql = "SELECT * FROM ".self::activos_table." ORDER BY prioridad DESC";
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

	public function insert_document($data = array('nombre'=>'','fecha'=>'','revision'=>'','proceso'=>'','tipo'=>'','sector'=>'','fecharev'=>'','path'=>'','vencimiento'=>''))
	{
		$sql = "INSERT INTO `documentos` (`id`, `nombre`, `fecha`, `revision`, `proceso`, `sector`, `fecharev`, `usuario`, `urlfile`, `duracion`) VALUES (NULL, '".$data['nombre']."', '2022-10-13', '".$data['revision']."', '".$data['proceso']."', '".$data['sector']."', '".$data['fecharev']."', '1', '".$data['path']."', '".$data['vencimiento']."')";
		$query = $this->db->query($sql);
			

	}


	public function listado_documentos()
	{
		$sql = "SELECT * FROM `documentos` ORDER BY documentos.proceso, documentos.nombre ASC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	public function get_document_path($id)
	{
		$sql = "SELECT urlfile FROM `documentos` WHERE id = '".$id."'";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		return $result;
	}
		
}

?>