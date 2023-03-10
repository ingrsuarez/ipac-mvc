<?php
class Empleados_model extends CI_Model {

        const table = 'empleados';


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

                $sql = "SELECT * FROM empleados WHERE id = $id";
                $query = $this->db->query($sql);
                return $query->row();
        }

        public function get_empleados_activos()
        {
                $sql = "SELECT * FROM empleados WHERE estatus = 'activo'";
                $query = $this->db->query($sql);
                $result = $query->result();
                return $result;

        }

        public function set_newPassword($id,$clave)
        {
                $sql = "UPDATE `empleados` SET clave = '".$clave."' WHERE id = ".$id;
                $query = $this->db->query($sql);
                
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
                if ($year <= date('Y'))
                {//Has already take vacation this year
                        $sql = "SELECT empleados.vacaciones-SUM(licencias.dias) as vacaciones, licencias.año as year FROM licencias INNER JOIN empleados ON licencias.empleado = empleados.id WHERE año = '".$year."' AND empleados.id = '".$id."' AND (licencias.estado = 'aprobado' OR licencias.estado = 'revision') GROUP BY empleado";
                        
                        $query = $this->db->query($sql);
                        $result = $query->row();
                        if (!empty($result)){
                                if ($result->vacaciones >= 0)
                                {
                                   return $result;     
                                }else
                                {
                                        $result->vacaciones = 0;
                                        return $result;
                                }

                                     
                        }else{//Never took vacacions this year
                                $sql2 = "SELECT empleados.vacaciones, '".$year."' as year FROM empleados WHERE empleados.id = ".$id;
                                $this->db->select($sql);
                                $query2 = $this->db->query($sql2);
                                $result = $query2->row();
                                return $result;
                        }
                        
                }else
                {       //Return all avalible vacation for current year
                        $sql3 = "SELECT empleados.vacaciones, '".$year."' as year FROM empleados WHERE empleados.id = ".$id;
                        $this->db->select($sql3);
                        $query3 = $this->db->query($sql3);
                        $result = $query3->row();
                        return $result; 
                }
               
                

        }

        private function existe_filaVacaciones($year, $usuario)
        {

                $sql = "SELECT * FROM `vacaciones` WHERE vacaciones.user = '".$usuario."' AND vacaciones.year = ".$year." LIMIT 1";
                $query = $this->db->query($sql);
                $result = $query->result();
                if(!empty($result)) {
                 return TRUE; 
                 }else{
                  return FALSE;
                }
        }

        private function dias_vacacionales_disponibles($idUsuario)
        {
            $year = date("Y");
            if($this->existe_filaVacaciones($year,$idUsuario))  
            {
                $sql = "SELECT name, (vacaciones.total_days - vacaciones.used_days) as dias_disponibles FROM `vacaciones` WHERE user = '".$idUsuario."' AND vacaciones.year = '".$year."' LIMIT 1";
                $query = $this->db->query($sql);
                $result = $query->result();
                return $result[0]->dias_disponibles;
            }else
            {
                $sql = "SELECT vacaciones FROM `empleados` WHERE id = ".$idUsuario;
                $query = $this->db->query($sql);
                $result = $query->result();
                
                return $result[0]->vacaciones;
            }  


        }

        private function total_dias_vacacionales ($id_usuario)
        {
                $sql = "SELECT vacaciones FROM `empleados` WHERE id = ".$id_usuario;
                $query = $this->db->query($sql);
                $result = $query->result();
                
                return $result[0]->vacaciones;
        }

        public function solicitar_licencia($fecha_inicial="",$fecha_final="",$tipo='vacaciones',$id_usuario='',$medico='')
        {

                $nombre_usuario = $this->session->userdata('nombre');
                if (empty($id_usuario)){
                        $id_usuario = $this->session->userdata('id');
                }
                
                $vacaciones_usuario = $this->session->userdata('vacaciones');
                $year = date("Y");
                $month = date("m");
                $today = date("Y-m-d H:i:s");
                $sql = "INSERT INTO `licencias` (`id`, `fecha`, `empleado`, `tipo`, `descripcion`, `fechaini`, `fechafin`, `justificado`, `medico`, `horas50`, `horas100`, `supervisor`, `mes`, `estado`) VALUES (NULL, '".$today."', '".$id_usuario."', '".$tipo."', 'vacaciones ".$year."', '".$fecha_inicial."', '".$fecha_final."', 'si', '".$medico."', '0', '0', '', '".$month."', 'revision')";
                $query = $this->db->query($sql);        
        }

        public function get_userName($id_usuario)
        {
                $sql = "SELECT nombre FROM empleados WHERE id = '".$id_usuario."'";
                $query = $this->db->query($sql);
                $result = $query->result();
                return $result[0]->nombre;

        }

        public function registrar_licencia($fecha_inicial="",$fecha_final="",$dias_solicitados="",$id_usuario)
        {
                $nombre_usuario = $this->Empleados_model->get_userName($id_usuario);
                $year = date("Y");
                $dias_disponibles = $this->Empleados_model->dias_vacacionales_disponibles($id_usuario);
                $total_dias_vacaciones = $this->Empleados_model->total_dias_vacacionales($id_usuario);

                if(!empty($fecha_inicial) )
                {
                        $year = date("Y");
                        //Check if has vacation row created
                        if (($this->existe_filaVacaciones($year,$id_usuario)) == FALSE )
                        {
                                $sql = "INSERT INTO `vacaciones` (`id`, `user`, `name`, `year`, `total_days`, `used_days`, `next_year_days`) VALUES (NULL, '".$id_usuario."', '".$nombre_usuario."', '".$year."', '".$dias_disponibles."', '0', '0')";
                                $query = $this->db->query($sql);
                        }

                        if ($dias_solicitados <= $dias_disponibles)
                        {
                                $sql = "UPDATE `vacaciones` SET `used_days`= `used_days`+'".$dias_solicitados."' WHERE user = ".$id_usuario;
                                $query = $this->db->query($sql);                                      
                        }else
                        {
                                $next_year = $year + 1;
                                // If next year row was already register?
                                if ($this->existe_filaVacaciones($next_year,$id_usuario))
                                {
                                        $sql = "UPDATE `vacaciones` SET `used_days`= `used_days`+'".$dias_solicitados."' WHERE user = ".$id_usuario." AND year = ".$next_year;
                                        $query = $this->db->query($sql);

                                }else{   
                                        //First time to register next year row 
                                        $dias_proximo_año = $dias_solicitados - $dias_disponibles;
                                        //fill current year row
                                        $sql = "UPDATE `vacaciones` SET `used_days`= `total_days`, `next_year_days` = '".$dias_proximo_año."' WHERE user = ".$id_usuario." AND year = ".$year;
                                        $query = $this->db->query($sql);
                                        $year +=1;
                                        //create next year row

                                        $sql = "INSERT INTO `vacaciones` (`id`, `user`, `name`, `year`, `total_days`, `used_days`, `next_year_days`) VALUES (NULL, '".$id_usuario."', '".$nombre_usuario."', '".$year."', '".$total_dias_vacaciones."', '".$dias_proximo_año."', '0')";
                                        $query = $this->db->query($sql);
                                }
                        }

                        
                }

        }

        public function get_licencias($id_usuario='', $year='',$month='')
        {
                if (empty($month))
                {
                        $month_filter = '';
                }else
                {
                        $month_filter = ' AND MONTH(fechaini) = '.$month."'";
                }
                
               if (!empty($id_usuario))
               {
                        $sql = "SELECT * FROM `licencias` WHERE `empleado` = '".$id_usuario."' AND `año` = '".$year."' ORDER BY  fechaini DESC";
                        $query = $this->db->query($sql);
                        $result = $query->result();
                        return $result;

               }        
               else
               {

                        $sql = "SELECT licencias.id, fecha, empleados.nombre, fechaini, fechafin, tipo, dias, estado FROM `licencias` 
                                INNER JOIN empleados ON licencias.empleado = empleados.id WHERE `año` = '".$year."' ".$month_filter." ORDER BY  fechaini DESC";
                        $query = $this->db->query($sql);
                        $result = $query->result();
                        return $result;
               }

        }

        public function get_licencias_revision($id_usuario='', $year='',$month='')
        {
                if (empty($month))
                {
                        $month_filter = '';
                }else
                {
                        $month_filter = ' AND MONTH(fechaini) = '.$month."'";
                }
                
               if (!empty($id_usuario))
               {
                        $sql = "SELECT * FROM `licencias` WHERE `empleado` = '".$id_usuario."' AND `año` = '".$year."' ORDER BY  fechaini DESC";
                        $query = $this->db->query($sql);
                        $result = $query->result();
                        return $result;

               }        
               else
               {

                        $sql = "SELECT licencias.id, fecha, empleados.nombre, fechaini, fechafin, tipo, dias, estado FROM `licencias` 
                                INNER JOIN empleados ON licencias.empleado = empleados.id WHERE `año` = '".$year."' ".$month_filter." AND estado <> 'rechazado' ORDER BY  fechaini DESC";
                        $query = $this->db->query($sql);
                        $result = $query->result();
                        return $result;
               }

        }

        public function aprobar_licencia($licencia_id='')
        {
                
                $sql = "SELECT * FROM licencias WHERE id = ".$licencia_id;
                $query = $this->db->query($sql);
                $result = $query->result();
                $estado = $result[0]->estado;
                $id_usuario = $result[0]->empleado;
                $fecha_inicial = $result[0]->fechaini;
                $fecha_final = $result[0]->fechafin;
                $dias_solicitados = $result[0]->dias;
                if ($estado <> 'aprobado')
                {
                        $sql = "UPDATE `licencias` SET estado = 'aprobado' WHERE licencias.id = '".$licencia_id."'";
                        $query = $this->db->query($sql);
                        $this->registrar_licencia($fecha_inicial,$fecha_final,$dias_solicitados,$id_usuario) ;
                }
        }

        public function rechazar_licencia($licencia_id='')
        {
                $sql = "SELECT estado FROM licencias WHERE licencias.id = '".$licencia_id."'";
                $query = $this->db->query($sql);
                $result = $query->result();
                if($result[0]->estado <> 'aprobado')
                {
                        $sql = "UPDATE `licencias` SET estado = 'rechazado' WHERE licencias.id = '".$licencia_id."'";
                        $query = $this->db->query($sql);

                }
                
                // $result = $query->result();

        }


        public function get_licencia_by_id($id_licencia='')
        {
                $sql = "SELECT licencias.id, fecha, empleados.nombre, empleados.dni, puestos.nombre AS puesto, fechaini, fechafin, tipo,estado FROM `licencias` INNER JOIN empleados ON licencias.empleado = empleados.id INNER JOIN puestos ON empleados.puesto = puestos.id WHERE licencias.id = '".$id_licencia."'";
                
                $query = $this->db->query($sql);
                $result = $query->result_array();
                return $result;
        }



//----------------------------DESEMPEÑO---------------------------------------//

        public function get_noConformidades_year($year, $usuarioId)
        {

                $sql = "SELECT  SUM(auditadoId = '".$usuarioId."')*100/count(*) as total FROM `vnoconformidades` WHERE YEAR(vnoconformidades.fecha) = ".$year;
                $query = $this->db->query($sql);
                $porcentaje = $query->row();
                $sql = "SELECT  count(*) as total FROM `vnoconformidades` WHERE YEAR(vnoconformidades.fecha) = ".$year." AND auditadoId = '".$usuarioId."'";
                $query = $this->db->query($sql);
                $cantidad = $query->row();
                $result = array($cantidad->total,round($porcentaje->total, 0));

                if(!empty($result)) {
                 return $result; 
                 }else{
                  return FALSE;
                }
        }       


        public function get_incidentes_year($year, $usuarioId)
        {

                $sql = "SELECT SUM(empleado = '".$usuarioId."')*100/count(*) as total FROM `reportes` WHERE YEAR(reportes.fecha) = ".$year." AND reportes.tipo = 'INCIDENTE'";
                $query = $this->db->query($sql);
                $porcentaje = $query->row();
                $sql = "SELECT count(*) as total FROM `reportes` WHERE YEAR(reportes.fecha) = ".$year." AND reportes.tipo = 'INCIDENTE' AND empleado = '".$usuarioId."'";
                $query = $this->db->query($sql);
                $cantidad = $query->row();
                $result = array($cantidad->total,round($porcentaje->total, 0));

                if(!empty($result)) {
                 return $result; 
                 }else{
                  return FALSE;
                }
        }

        public function get_meritos_year($year, $usuarioId)
        {      

                $sql = "SELECT SUM(empleado = '".$usuarioId."')*100/count(*) as total FROM `meritos` WHERE YEAR(meritos.fecha) = ".$year;
                $query = $this->db->query($sql);
                $porcentaje = $query->row();
                $sql = "SELECT count(*) as total FROM `meritos` WHERE YEAR(meritos.fecha) = ".$year." AND empleado = '".$usuarioId."'";
                $query = $this->db->query($sql);
                $cantidad = $query->row();
                $result = array($cantidad->total,round($porcentaje->total, 0));

                if(!empty($result)) {
                 return $result; 
                 }else{
                  return FALSE;
                }
        } 
        
}