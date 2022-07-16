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

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url_helper');
        $this->load->model('Empleados_model');

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
    	//Obtengo las vacaciones pendientes del año seleccionado
        $id = $this->session->userdata('id');
    	$licencias = $this->Empleados_model->get_vacaciones($id,$year);
        
    	$data['vacaciones'] = $licencias->vacaciones;
    	if ($year == FALSE){
    		$year = date('Y');
    	}

    	if ($month == FALSE){
    		$month = date('m');
    	}
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

        {table_close}</table>{/table_close}
';

    	$this->load->library('calendar',$prefs);
    	$data['year'] = $year;
    	$data['month'] = $month;
    	
    	$data['title'] = 'Calendario';
		$this->load->view('templates/head', $data);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/aside', $this->session->userdata());

		$this->load->view('rrhh/pedidoVacaciones', $data);	
		$this->load->view('rrhh/calendario', $data);

		$this->load->view('templates/footer', $data);

    }
}
