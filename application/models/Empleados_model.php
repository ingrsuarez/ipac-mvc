<?php
class Empleados_model extends CI_Model {

        public $table = 'empleados';

        public function __construct()
        {
                $this->load->database();
        }


        public function get_empleado($id = FALSE)
        {
                $this->db->select();
                // $this->db->from($this->table);
                if ($id === FALSE)
                {
                        $query = $this->db->get($this->table);
                        return $query->row();
                }

                $query = $this->db->get_where($this->table, array('id' => $id));
                return $query->row();
        }

        public function get_vacaciones($id = FALSE, $year = "")
        {
                
                if ($id === FALSE)
                {
                        $query = $this->db->get($this->table);
                        return $query->row();
                }
                if (empty($year)){
                        $year = date('Y');
                }
                if ($year <= date('Y')){//Has already take vacation this year
                        $sql = "SELECT empleados.vacaciones-SUM(licencias.dias) as vacaciones, licencias.año as year FROM licencias INNER JOIN empleados ON licencias.empleado = empleados.id WHERE año = '".$year."' AND empleados.id = '".$id."' AND licencias.estado <> 'ANULADO' GROUP BY empleado";
                        $this->db->select($sql);
                        $query = $this->db->query($sql);
                        $result = $query->row();
                        if (!empty($result)){
                             return $result;   
                        }else{//Never took vacacions this year
                                $sql2 = "SELECT empleados.vacaciones, '".$year."' as year FROM empleados WHERE empleados.id = ".$id;
                                $this->db->select($sql);
                                $query2 = $this->db->query($sql2);
                                $result = $query2->row();
                                return $result;
                        }
                        
                }else
                {
                        $sql3 = "SELECT empleados.vacaciones, '".$year."' as year FROM empleados WHERE empleados.id = ".$id;
                        $this->db->select($sql3);
                        $query3 = $this->db->query($sql3);
                        $result = $query3->row();
                        // $result = $row->vacaciones;
                        
                        return $result; 
                }
               
                

        }


}