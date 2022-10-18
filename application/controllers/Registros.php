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
	 * 
	 */
	const sector = "17";

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('download');
        $this->load->model('Secure_model');
        $this->load->model('empleados_model');
        $this->load->model('Registros_model');
        $this->load->helper('url_helper');
        $this->load->helper(array('form', 'url'));
    }

    public function do_upload()
    {
    	

    	$path = $this->input->post('proceso')."/".$this->input->post('tipo');
    	if (!file_exists('./documentos/'.$path)) {
		    mkdir('./documentos/sistema/'.$path, 0777, true);
		}
		
        $config['upload_path']          = './documentos/sistema/'.$path;
        $config['allowed_types']        = 'pdf|jpg|png';
        $config['max_size']             = 8000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
                $error = $this->upload->display_errors('','');

               	
	    		echo ("<script>
	    		alert('".$error."')</script>");
	    		redirect('/registros/insertar_documento/', 'refresh');
        }
        else
        {

            // $data = array('upload_data' => $this->upload->data());
            $file = $this->upload->data();
            $today = date("Y-m-d H:i:s");
        	$data = array('nombre'=> $this->input->post('nombre'),
        		'fecha'=>$today,
        		'revision'=>$this->input->post('revision'),
        		'proceso'=>$this->input->post('proceso'),
        		'tipo'=>$this->input->post('tipo'),
        		'sector'=>$this->input->post('sector'),
        		'fecharev'=>$this->input->post('fecharev'),
        		'path'=>'/documentos/sistema/'.$path."/".$file['file_name'],
        		'vencimiento'=>$this->input->post('vencimiento'));
        	$this->Registros_model->insert_document($data);
            redirect('/registros/insertar_documento/', 'refresh');
                
        }
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

	public function viewfile($filename){
    	if ($this->session->has_userdata('usuario'))
        {

	        $tofile= base_url($fileName);
	        header('Content-Type: application/pdf');
	        readfile($tofile);
	    }else
        {
        	 redirect('/secure/login', 'refresh');
        }    
    }


// DOCUMENTOS DEL SISTEMA --------------->

    public function insertar_documento($action="")
    {
    	if ($this->session->has_userdata('usuario'))
        {
        	if (empty($action))
 			{
 				$sector = $this->Registros_model->list_sectores();
 				$procesos = $this->Registros_model->list_procesos();
				$data['sector'] = $sector;
				$data['procesos'] = $procesos;
				$data['error'] = '';
	        	$this->load->view('templates/head_compras');
	        	$this->load->view('templates/header_registros');
	        	$this->load->view('templates/aside', $this->session->userdata());	
		        $this->load->view('registros/ingresar_documentos',$data);
		        $this->load->view('templates/footer');
 			}elseif ($action == "upload")
 			{
				var_dump($_POST);
				// $this->do_upload('userfile');
        	}
        }else
        {
        	redirect('/secure/login', 'refresh');
        }

    }

    public function listado_documentos($parameter="")
    {
    	if ($this->session->has_userdata('usuario'))
        {
        	$action = substr($parameter, 0, 8);
        	if (empty($parameter))
        	{
        		$data['listado'] = $this->Registros_model->listado_documentos();
	        	$this->load->view('templates/head_compras');
	        	$this->load->view('templates/header_registros');
	        	$this->load->view('templates/aside', $this->session->userdata());	
		        $this->load->view('registros/listado_documentos',$data);
		        $this->load->view('templates/footer');

        	}elseif($action="imprimir")
        	{
        		$id = $this->input->get('documentId');
        		$fileName = $this->Registros_model->get_document_path($id);

        		$tofile= base_url($fileName['urlfile']);
		        header('Content-Type: application/pdf');
		        readfile($tofile);
        	}
        	


        }else
        {
        	redirect('/secure/login', 'refresh');
        }
    }


// CIRCULARES ----------------------->
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


//NO CONFORMIDADES ------------------->

    public function no_conformidades($action="")
    {
    	if ($this->session->has_userdata('usuario'))
        {
        	$acceso_registros = $this->Secure_model->access(self::sector);
            

            if ($acceso_registros < 3)
            {
	 			if (empty($action))
	 			{
	 				$sector = $this->Registros_model->list_sectores();
	 				$procesos = $this->Registros_model->list_procesos();
	 				$data['empleados'] = $this->empleados_model->get_empleados_activos();
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
	 				$array_noConformidad = array('fecha' => $today,
	 										'titulo' => $this->input->post('titulo'),
	 										'descripcion' => $this->input->post('descripcion'),
	 										'accionin' => $this->input->post('accion_inmediata'),
	 										'ingreso' => $userId,
	 										'empleado1' => $this->input->post('empleado1'),
	 										'tipo' => $this->input->post('tipo'),
	 										'proceso' => $this->input->post('proceso'),
	 										'sector' => $this->input->post('sector'),
	 										'causas' => $this->input->post('causas'),
	 										'estado' => 'revision');
	 				$this->Registros_model->insert_noConformidad($array_noConformidad);
	 				unset($_POST);
	                redirect('/registros/no_conformidades/', 'refresh');
	 			}
	 		}else
            {
                $mensaje = "Usted no tiene acceso a este modulo!";
                echo ("<script>
                alert('".$mensaje."')</script>");
                redirect('/registros/circulares', 'refresh');
            }


	    }else
        {
        	 redirect('/secure/login', 'refresh');
        }  

	}

// ORDENES DE TRABAJO ------------------------>


    public function orden_trabajo($action="")
    {
    	if ($this->session->has_userdata('usuario'))
        {
        	$acceso_registros = $this->Secure_model->access(self::sector);
            

            if ($acceso_registros < 5)
            {
	 			if (empty($action))
	 			{
	 				$sector = $this->Registros_model->list_sectores();
	 				$procesos = $this->Registros_model->list_procesos();
	 				$data['activos'] = $this->Registros_model->list_activos();
					$data['sector'] = $sector;
					$data['procesos'] = $procesos;
		        	$this->load->view('templates/head_compras');
		        	$this->load->view('templates/header_registros');
		        	$this->load->view('templates/aside', $this->session->userdata());	
			        $this->load->view('registros/nueva_orden',$data);
			        $this->load->view('templates/footer');
	 			}elseif ($action == "nueva")
	 			{
	 			
	 				$userId = $this->session->userdata('id');
	        		$today = date("Y-m-d H:i:s");
	 				$array_ordenTrabajo = array('fecha' => $today,
	 										'equipo' => $this->input->post('activo'),
	 										'tipo' => $this->input->post('tipo'),
	 										'usuario' => $userId,
	 										'descripcion' => $this->input->post('descripcion'),
	 										'horas' => $this->input->post('horas'),
	 										'fechaAct' => $today,
	 										'sector' => $this->input->post('sector'),
	 										'estado' => 'abierta');
	 				$this->Registros_model->insert_orden_trabajo($array_ordenTrabajo);
	 				unset($_POST);
	                redirect('/registros/orden_trabajo/', 'refresh');
	 			}
	 		}else
            {
                $mensaje = "Usted no tiene acceso a este modulo!";
                echo ("<script>
                alert('".$mensaje."')</script>");
                redirect('/registros/circulares', 'refresh');
            }


	    }else
        {
        	 redirect('/secure/login', 'refresh');
        }  

    }

 
    public function listado_ordenes($param="")
    {
    	if ($this->session->has_userdata('usuario'))
        {
        	if (empty($param))
		        {
				    $data['ordenes'] = $this->Registros_model->list_ordenes_trabajo();
				    $data['activos'] = $this->Registros_model->list_activos();
					$this->load->view('templates/head_compras');
		        	$this->load->view('templates/header_registros');
			    	$this->load->view('templates/aside', $this->session->userdata());
			    	$this->load->view('registros/listado_ordenes',$data);
			    	$this->load->view('templates/footer');
	
				}elseif ($param == "listado")
			    {
			    	
			    	$estado = $this->input->post('estadoOrden'); 
					
					$array['ordenes'] = $this->Registros_model->list_ordenes_trabajo($estado);
					
			    	print_r(json_encode($array['ordenes']));
			    }elseif ($param == "equipo")
			    {
			    	
			    	$equipo = $this->input->post('iequipo'); 
					
	                
					$array['ordenes'] = $this->Registros_model->list_ordenes_trabajo_Xequipo($equipo);
					
			    	print_r(json_encode($array['ordenes']));
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