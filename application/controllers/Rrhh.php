<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Rrhh extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

    const sector = 18;

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url_helper');
        $this->load->model('Empleados_model');
        $this->load->model('Secure_model');

    }

	public function view($page = 'pedidoVacaciones',$empleado = array())
	{

		 if ( ! file_exists(APPPATH.'views/rrhh/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
        // $this->load->helper('url');
        $data = array();
        $data['title'] = $page;
        $this->load->model('Empleados_model');
        $empleado = $this->Empleados_model->get_empleado($id);
        $this->load->view('templates/head', $data);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/aside', $this->session->userdata());
        $this->load->view('rrhh/pedidoVacaciones', $empleado);
        $this->load->view('templates/footer', $data);

	}



    public function view_empleado($id = NULL)
    {
    	$id = $this->session->userdata('id');
        $data['empleados_item'] = $this->Empleados_model->get_empleado($id);
        $data['title'] = 'Empleados archive';
        $licencias = $this->Empleados_model->get_vacaciones(1);
        $this->load->view('templates/head', $data);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/aside', $this->session->userdata());
        $this->load->view('rrhh/pedidoVacaciones', $licencias);	
        $this->load->view('templates/footer', $data);

       
    }

    public function calendario($year = FALSE, $month = FALSE)
    {
    	
        if ($this->session->has_userdata('usuario'))
        {
            //Obtengo las vacaciones pendientes del año seleccionado
            $id_usuario = $this->session->userdata('id');
        	$licencias = $this->Empleados_model->get_vacaciones($id_usuario,$year);
            $parameter = substr($year, 0, 8);

        	$data['vacaciones'] = $licencias->vacaciones;
        	if ($year == FALSE){
        		$year = date('Y');
        	}

        	if ($month == FALSE){
        		$month = date('m');
        	}
            
            if ($parameter == 'imprimir')
            {
                $userDNI = $this->session->userdata('dni');
                $id = $_GET['lid'];
                $licencia = $this->Empleados_model->get_licencia_by_id($id);
                if ($licencia[0]['dni'] == $userDNI)
                    {
                       $this->load->view('rrhh/pdfLicencia.php',$licencia[0]); 
                    }


                // 

            }else
            {
                $prefs = array(
                'show_next_prev'=> TRUE,
                'next_prev_url' => base_url().'index.php/rrhh/calendario'
                );

                $prefs['template'] = '

                {table_open}<table class="tCalendar" border="0" cellpadding="1" cellspacing="18px">{/table_open}

                {heading_row_start}<tr>{/heading_row_start}

                {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
                {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
                {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

                {heading_row_end}</tr>{/heading_row_end}

                {week_row_start}<tr>{/week_row_start}
                {week_day_cell}<td>{week_day}</td>{/week_day_cell}
                {week_row_end}</tr>{/week_row_end}

                {cal_row_start}<tr>{/cal_row_start}
                {cal_cell_start}<td>{/cal_cell_start}
                {cal_cell_start_today}<td>{/cal_cell_start_today}
                {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

                {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
                {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

                {cal_cell_no_content}{day}{/cal_cell_no_content}
                {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

                {cal_cell_blank}&nbsp;{/cal_cell_blank}

                {cal_cell_other}{day}{/cal_cel_other}

                {cal_cell_end}</td>{/cal_cell_end}
                {cal_cell_end_today}</td>{/cal_cell_end_today}
                {cal_cell_end_other}</td>{/cal_cell_end_other}
                {cal_row_end}</tr>{/cal_row_end}

                {table_close}</table>{/table_close}';
                $data['licencias'] = $this->Empleados_model->get_licencias($id_usuario,$year);
                $this->load->library('calendar',$prefs);
                $data['year'] = $year;
                $data['month'] = $month;
                $data['title'] = 'Calendario';
                $this->load->view('templates/head', $data);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $this->session->userdata());
                $this->load->view('rrhh/pedidoVacaciones', $data);  
                $this->load->view('templates/footer', $data);
            }
        	
        }else
        {
             redirect('/secure/login', 'refresh');
        }

    }

    public function solicitar_vacaciones()
    {
        if ($this->session->has_userdata('usuario'))
        {
            $fecha_inicial = new DateTime($this->input->post('fechai'));
            $fecha_final = new DateTime($this->input->post('fechafin'));
            $differ = $fecha_final->diff($fecha_inicial);       
            $dias_solicitados = $differ->days+1;
            $year = date("Y");
           
            $this->Empleados_model->solicitar_licencia($fecha_inicial->format('Y-m-d H:i:s'),$fecha_final->format('Y-m-d H:i:s'),'vacaciones');
            redirect('/rrhh/calendario', 'refresh');
        }else
        {
             redirect('/secure/login', 'refresh');
        }

    }


    public function insertar_licencia()
    {
        if ($this->session->has_userdata('usuario'))
        {
            $fecha_inicial = new DateTime($this->input->post('fechai'));
            $fecha_final = new DateTime($this->input->post('fechafin'));
            $id_usuario = $this->input->post('empleado');
            $medico = $this->input->post('medico');
            $tipo = $this->input->post('tipo');
            $differ = $fecha_final->diff($fecha_inicial);       
            $dias_solicitados = $differ->days+1;
            $year = date("Y");
           
            $this->Empleados_model->solicitar_licencia($fecha_inicial->format('Y-m-d H:i:s'),$fecha_final->format('Y-m-d H:i:s'),$tipo,$id_usuario,$medico);
             redirect('/rrhh/panel', 'refresh');
        }else
        {
             redirect('/secure/login', 'refresh');
        }

    }

    public function registrar_vacaciones($param="")
    {
        if ($this->session->has_userdata('usuario'))
        {    
            $fecha_inicial = new DateTime($this->input->post('fechai'));
            $fecha_final = new DateTime($this->input->post('fechafin'));
            $differ = $fecha_final->diff($fecha_inicial);       
            $dias_solicitados = $differ->days+1;
            $year = date("Y");
            
            $this->Empleados_model->registrar_licencia($fecha_inicial,$fecha_final,$dias_solicitados);
        }else
        {
             redirect('/secure/login', 'refresh');
        }

    }

    public function panel($param="")
    {

        if ($this->session->has_userdata('usuario'))
        {
            $acceso_rrhh = $this->Secure_model->access(self::sector);
            $empleados = $this->Empleados_model->get_empleados_activos();
            $data['empleados'] = $empleados;

            if ($acceso_rrhh < 2)
            {
                if (empty($param))
                {
                    $id_usuario = ""; //All users in revision    
                    $year = date("Y");

                    $data['licencias'] = $this->Empleados_model->get_licencias($id_usuario,$year);
                    $this->load->view('templates/head', $data);
                    $this->load->view('templates/header', $data);
                    $this->load->view('templates/aside', $this->session->userdata());
                    $this->load->view('rrhh/panel', $data);  
                    $this->load->view('templates/footer', $data);
                }elseif ($param == "aprobar")
                {
                    $licencia_id = $this->input->post('licencia'); 
                    $tipo = $this->input->post('tipo');
                    if ($tipo == 'vacaciones')
                    {
                        $this->Empleados_model->aprobar_licencia($licencia_id);
                    }   
                    redirect('/rrhh/panel', 'refresh');
                }elseif ($param == "rechazar")
                {
                    $licencia_id = $this->input->post('licencia');    
                    $this->Empleados_model->rechazar_licencia($licencia_id);
                    redirect('/rrhh/panel', 'refresh');
                }
            }else
            {
                $mensaje = "Usted no tiene acceso a este modulo!";
                echo ("<script>
                alert('".$mensaje."')</script>");
                redirect('/rrhh/calendario', 'refresh');
            }
        }else
        {
             redirect('/secure/login', 'refresh');
        }
    }

    public function modificar_clave($param="")
    {
        if ($this->session->has_userdata('usuario'))
        {   
            $id = $this->session->userdata('id');
            $this->load->model('Empleados_model');
            if($param == "modificar")
            {
                $clave_registrada = $this->session->userdata('clave');
                $clave_antigua = $this->input->post('clave');
                $clave_nueva = $this->input->post('nuevaClave');
                $clave_repetida = $this->input->post('claveRepetida');
                if ($clave_nueva <> $clave_repetida)
                {
                    echo ("<script>
                    alert('Las claves no coinciden!')</script>");
                    redirect('/rrhh/modificar_clave', 'refresh');
                }elseif ($clave_registrada == md5($clave_antigua))
                {
                    $clave = md5($clave_nueva);
                    $this->Empleados_model->set_newPassword($id,$clave);
                    echo ("<script>
                    alert('Su clave fue modificada con éxito!')</script>");
                    redirect('/pages/index', 'refresh');

                }else{
                    echo ("<script>
                    alert('La clave actual no coincide!')</script>");
                    redirect('/rrhh/modificar_clave', 'refresh');
                }

            }else{
                
                $data['empleados_item'] = $this->Empleados_model->get_empleado($id);
                $data['title'] = 'Empleados archive';
                
                $empleado = $this->Empleados_model->get_empleado($id);
                $this->load->view('templates/head', $data);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $this->session->userdata());
                $this->load->view('rrhh/modificar_clave', $empleado);
                $this->load->view('templates/footer', $data);
            }
            
        }else
        {
             redirect('/secure/login', 'refresh');
        }


    }

}
