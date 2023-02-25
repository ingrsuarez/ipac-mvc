<?php 


class Registros_model extends CI_Model {

	public $usrId = "";
	const circulares_table = "circulares";
	const vcirculares_table = "vcirculares";
	const noConformidades_table = "ncregistros";
	const vnoConformidades_abiertas = "vncabiertas";
	const sector_table = "sector";
	const procesos_table = "procesos";
	const politicas_table = "politicas";
	const activos_table = "activos";
	const orden_trabajo_table = "ordentrabajo";
	const reportes_table = "reportes";
	const meritos_table = "meritos";
	const asignaciones_table = "asignaciones";
	const vorden_trabajo_table = "votrabajo";
	const vreportes_table = "vreportes";
	const vNoConformidades_table ="vnoconformidades";


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

	public function update_noConformidad($array,$id)
	{
		$this->db->where('id', $id);
		$this->db->update(self::noConformidades_table,$array);
	}

	public function insert_orden_trabajo($array)
	{
		$this->db->insert(self::orden_trabajo_table,$array); 		
	}

	private function last_id($table)
	{
		$sql = "SELECT MAX(id) as last_id FROM ".$table;
		$query = $this->db->query($sql);
		$result = $query->row_array();

		return $result;

	}

	public function insert_reporte($array)
	{
		if(empty($array['tarea']))
		{
			$this->db->insert(self::reportes_table,$array);	
		}else{
			$tarea = array(
				'fecha'=> $array['fecha'],
				'empleado'=> $array['empleado'],
				'descripcion'=> $array['tarea'],
				'origen'=> 'REPORTE',
				'supervisor'=> $array['usuario'],
				'fechaActualizacion	'=>$array['fecha'],
				'estado'=>'pendiente');
			$this->db->insert(self::asignaciones_table,$tarea);
			$id_tarea = $this->last_id(self::asignaciones_table);
			$array['tarea'] = $id_tarea['last_id'];
			$this->db->insert(self::reportes_table,$array);
		}
		 		
	}

	public function insert_merito($array)
	{
	
		$this->db->insert(self::meritos_table,$array);	
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

	public function list_politicas($value='')
	{
		$sql = "SELECT * FROM ".self::politicas_table." ORDER BY nombre ASC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function list_activos($value='')
	{
		$sql = "SELECT * FROM ".self::activos_table."  ORDER BY prioridad DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function get_noConformidad($id)
	{
		$sql = "SELECT * FROM ".self::vNoConformidades_table." WHERE id =".$id." LIMIT 1";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		return $result;

	}

	public function mis_noConformidades($userId)
	{
		$sql = "SELECT * FROM ".self::vNoConformidades_table." WHERE auditadoId = ".$userId." ORDER BY fecha DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function list_no_conformidades($tipo="")
	{
		if (empty($tipo))
		{
			$sql = "SELECT * FROM ".self::vNoConformidades_table." ORDER BY fecha DESC";
			$query = $this->db->query($sql);
			$result = $query->result();
			return $result;
		}else{
			$sql = "SELECT * FROM ".self::vNoConformidades_table." WHERE tipo = '".$tipo."' ORDER BY fecha DESC";
			$query = $this->db->query($sql);
			$result = $query->result();
			return $result;
		}
	}

	public function list_no_conformidades_empleado($tipo="",$id)
	{
		if (empty($tipo))
		{
			$sql = "SELECT * FROM ".self::vNoConformidades_table." WHERE auditadoId = '".$id."' ORDER BY fecha DESC";
			$query = $this->db->query($sql);
			$result = $query->result();
			return $result;
		}else{
			$sql = "SELECT * FROM ".self::vNoConformidades_table." WHERE tipo = '".$tipo."' AND auditadoId = '".$id."' ORDER BY fecha DESC";
			$query = $this->db->query($sql);
			$result = $query->result();
			return $result;
		}
	}

		public function list_no_conformidades_estado($estado="")
	{
		if (empty($estado))
		{
			$sql = "SELECT * FROM ".self::vNoConformidades_table." ORDER BY fecha DESC";
			$query = $this->db->query($sql);
			$result = $query->result();
			return $result;
		}else{
			$sql = "SELECT * FROM ".self::vNoConformidades_table." WHERE estado = '".$estado."' ORDER BY fecha DESC";
			$query = $this->db->query($sql);
			$result = $query->result();
			return $result;
		}
		

	}

	public function empleado_no_conformidades($userId)
	{
		$sql = "SELECT * FROM ".self::vNoConformidades_table." WHERE auditadoId = ".$userId." ORDER BY fecha DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function list_reportes($tipo="")
	{
		$sql = "SELECT * FROM ".self::vreportes_table." WHERE tipo = '".$tipo."' ORDER BY fecha DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;

	}

	public function list_reportes_empleado($tipo,$userNombre)
	{
		$sql = "SELECT * FROM ".self::vreportes_table." WHERE tipo = '".$tipo."' AND nombre = '".$userNombre."' ORDER BY fecha DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function listado_empleado_reportes($nombre_empleado)
	{
		$sql = "SELECT * FROM ".self::vreportes_table." WHERE nombre = '".$nombre_empleado."' ORDER BY fecha DESC";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}



	public function get_reportes($idArray)
	{
		if (!empty($idArray))
		{
			$sql = "SELECT * FROM `".self::vreportes_table."` WHERE `id` IN (".$idArray.")";
			$query = $this->db->query($sql);
			$result = $query->result_array();
			return $result;
		}

	}

	

	public function list_ordenes_trabajo($estado="")
	{
		
		$sql = "SELECT * FROM ".self::vorden_trabajo_table." WHERE estado = '".$estado."' ORDER BY fecha DESC";
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
		$sql = "INSERT INTO `documentos` (`id`, `nombre`, `fecha`, `revision`, `proceso`, `sector`,`tipo`, `fecharev`, `usuario`, `urlfile`, `duracion`) VALUES (NULL, '".$data['nombre']."', '2022-10-13', '".$data['revision']."', '".$data['proceso']."', '".$data['sector']."', '".$data['tipo']."', '".$data['fecharev']."', '1', '".$data['path']."', '".$data['vencimiento']."')";
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