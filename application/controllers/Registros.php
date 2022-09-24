<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registros extends CI_Controller {

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
	const sector = "5";

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('download');
        $this->load->model('Secure_model');
        $this->load->model('empleados_model');
        $this->load->model('Registros_model');
        $this->load->helper('url_helper');

    }



    public function download($filename = NULL)
    {
    	if ($this->session->has_userdata('usuario'))
        {

        	// download file contents
		    $data = file_get_contents(base_url('/procedimientos/09/'.$filename));
		    force_download($filename, $data);
        	
        }else
        {
        	 redirect('/secure/login', 'refresh');
        }
    }

    public function viewfile(){
    	if ($this->session->has_userdata('usuario'))
        {
	        $sector = $this->uri->segment(3);
	        $fname = $this->uri->segment(4);
	        $tofile= base_url('/procedimientos/'.$sector.'/'.$fname);
	        header('Content-Type: application/pdf');
	        readfile($tofile);
	    }else
        {
        	 redirect('/secure/login', 'refresh');
        }    
    }

    public function circulares($action="")
    {
    	if ($this->session->has_userdata('usuario'))
        {
 			if (empty($action))
 			{
 				$sector = $this->Registros_model->list_sectores();
 				$procesos = $this->Registros_model->list_procesos();
				$data['sector'] = $sector;
				$data['procesos'] = $procesos;
	        	$this->load->view('templates/head_compras');
	        	$this->load->view('templates/header_registros');
	        	$this->load->view('templates/aside', $this->session->userdata());	
		        $this->load->view('registros/circulares',$data);
		        $this->load->view('templates/footer');
 			}elseif ($action == "nueva")
 			{
 				
 				$userId = $this->session->userdata('id');
        		$today = date("Y-m-d H:i:s");
 				$array_circular = array('fecha' => $today,
 										'titulo' => $this->input->post('titulo'),
 										'descripcion' => $this->input->post('descripcion'),
 										'creador' => $userId,
 										'tipo' => $this->input->post('tipo'),
 										'proceso' => $this->input->post('proceso'),
 										'sector' => $this->input->post('sector'),
 										'tareas' => $this->input->post('tareas'),
 										'estado' => 'revision');
 				$this->Registros_model->insert_circular($array_circular);
 				unset($_POST);
                redirect('/registros/circulares/', 'refresh');
 			}


	    }else
        {
        	 redirect('/secure/login', 'refresh');
        }  


    }

    public function circulares_activas($param="")
    {
    	if ($this->session->has_userdata('usuario'))
	        { 
		        if (empty($param))
		        {
			    	$circulares = $this->Registros_model->list_circulares();
				    $data['circulares'] = $circulares;
					$this->load->view('templates/head_compras');
		        	$this->load->view('templates/header_registros');
			    	$this->load->view('templates/aside', $this->session->userdata());
			    	$this->load->view('registros/circulares_activas',$data);
			    	$this->load->view('templates/footer');

			    	
				}elseif ($param == "listado")
			    {
			    	$idCircular = $this->input->post('idCircular');	
			    	$estado = $this->input->post('idCircular'); 
					// $idProveedor = 1;
					$array['circulares'] = $this->Registros_model->list_circulares($idCircular);
					
			    	print_r(json_encode($array['circulares']));
		    	}
	    }else
	        {
	        	 redirect('/secure/login', 'refresh');
	        }
    }

    public function pdf_circulares()
    {
	    //Circular to print
	    // var_dump($_POST);
		$data['estado'] = $this->input->post('iestado');
		$data['action'] = $this->input->post('print');
		$data['idCircular'] = $this->input->post('select');
		if (($data['estado'] == "caducada") || ($data['estado'] == "revision") ){
			$mensaje = "Por favor seleccione una circular activa!";
			echo ("<script>
			alert('".$mensaje."')</script>");
			redirect('/registros/circulares_activas/', 'refresh');
		}else
		{
			if (!empty($data['idCircular']))
			{
				$data['circular_selected'] = $this->Registros_model->get_circular($data['idCircular'])[0];//Fila
				// var_dump($data['circular_selected']);
				$this->load->view('registros/pdfCirculares',$data);
			}else
			{
				//User didn´t select circular!	
				$mensaje = "Por favor seleccione una circular!";
				echo ("<script>
				alert('".$mensaje."')</script>");
				redirect('/registros/circulares_activas/', 'refresh');
			}
		}
		
  	}


  	public function editar_circulares()
    {
    	if ($this->session->has_userdata('usuario'))
        {
        	$this->session->set_userdata('last_page', 'editar_circulares');
        	$access = $this->session->userdata('puesto');
        	$delete = $this->input->post('delete');
        	$user = $this->session->userdata('usuario');
        	$circulares = $this->Registros_model->list_vcirculares();
        	$data['circulares'] = $circulares;
        	// var_dump($circulares);
			$this->load->view('templates/head_compras');
        	$this->load->view('templates/header_registros');
        	$this->load->view('templates/aside', $this->session->userdata());
        	$this->load->view('registros/editar_circulares',$data);
        	$this->load->view('templates/footer');
        	
        }else
        {
        	 redirect('/secure/login', 'refresh');
        }
    }

    public function activar_circular()
    {
    	if ($this->session->has_userdata('usuario'))
        {
        	$idCircular = $this->input->post('circularActivar');
        	$result = $this->Registros_model->activar_circular($idCircular);
        	redirect('/registros/editar_circulares/', 'refresh');

        }else
        {
        	 redirect('/secure/login', 'refresh');
        }
    }

    public function anular_circular()
    {
    	if ($this->session->has_userdata('usuario'))
        {

        	$idCircular = $this->input->post('delete');
        	$result = $this->Registros_model->anular_circular($idCircular);
        	redirect('/registros/editar_circulares/', 'refresh');
        	
        }else
        {
        	 redirect('/secure/login', 'refresh');
        }
    }



    public function no_conformidades($action="")
    {
    	if ($this->session->has_userdata('usuario'))
        {
 			if (empty($action))
 			{
 				$sector = $this->Registros_model->list_sectores();
 				$procesos = $this->Registros_model->list_procesos();
				$data['sector'] = $sector;
				$data['procesos'] = $procesos;
	        	$this->load->view('templates/head_compras');
	        	$this->load->view('templates/header_registros');
	        	$this->load->view('templates/aside', $this->session->userdata());	
		        $this->load->view('registros/no_conformidades',$data);
		        $this->load->view('templates/footer');
 			}elseif ($action == "nueva")
 			{
 				
 				$userId = $this->session->userdata('id');
        		$today = date("Y-m-d H:i:s");
 				$array_circular = array('fecha' => $today,
 										'titulo' => $this->input->post('titulo'),
 										'descripcion' => $this->input->post('descripcion'),
 										'creador' => $userId,
 										'tipo' => $this->input->post('tipo'),
 										'proceso' => $this->input->post('proceso'),
 										'sector' => $this->input->post('sector'),
 										'tareas' => $this->input->post('tareas'),
 										'estado' => 'revision');
 				$this->Registros_model->insert_circular($array_circular);
 				unset($_POST);
                redirect('/registros/circulares/', 'refresh');
 			}


	    }else
        {
        	 redirect('/secure/login', 'refresh');
        }  


    }

   
   	public function nueva_reunion($action="")
    {
    	if ($this->session->has_userdata('usuario'))
        {
 			if (empty($action))
 			{
 				$sector = $this->Registros_model->list_sectores();
 				$procesos = $this->Registros_model->list_procesos();
				$data['sector'] = $sector;
				$data['procesos'] = $procesos;
	        	$this->load->view('templates/head_compras');
	        	$this->load->view('templates/header_registros');
	        	$this->load->view('templates/aside', $this->session->userdata());	
		        $this->load->view('registros/nueva_reunion',$data);
		        $this->load->view('templates/footer');
 			}elseif ($action == "nueva")
 			{
 				
 				$userId = $this->session->userdata('id');
        		$today = date("Y-m-d H:i:s");
 				$array_circular = array('fecha' => $today,
 										'titulo' => $this->input->post('titulo'),
 										'descripcion' => $this->input->post('descripcion'),
 										'creador' => $userId,
 										'tipo' => $this->input->post('tipo'),
 										'proceso' => $this->input->post('proceso'),
 										'sector' => $this->input->post('sector'),
 										'tareas' => $this->input->post('tareas'),
 										'estado' => 'revision');
 				$this->Registros_model->insert_circular($array_circular);
 				unset($_POST);
                redirect('/registros/circulares/', 'refresh');
 			}


	    }else
        {
        	 redirect('/secure/login', 'refresh');
        }  

    }
}


?>