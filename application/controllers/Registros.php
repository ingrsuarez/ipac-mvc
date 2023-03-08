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
        $this->load->model('Novedades_model');
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


// <------------------------DOCUMENTOS DEL SISTEMA --------------->

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


// <----------------------------CIRCULARES ----------------------->
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
	    $acceso_registros = $this->Secure_model->access(self::sector);
		$data['estado'] = $this->input->post('iestado');
		$data['action'] = $this->input->post('action');
		$data['idCircular'] = $this->input->post('select');
		if ($data['action'] == 'print')
		{
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
		}elseif ($data['action'] == 'activate')
		{
            if ($acceso_registros <= 2)
            {
			$this->Registros_model->activar_circular($data['idCircular']);
			redirect('/registros/circulares_activas/', 'refresh');	
			}else{
				$mensaje = "No tiene acceso para activar circulares!";
					echo ("<script>
					alert('".$mensaje."')</script>");
					redirect('/registros/circulares_activas/', 'refresh');
			}
		}elseif ($data['action'] == 'deactivate')
		{
			if ($acceso_registros <= 3)
            {
				$this->Registros_model->anular_circular($data['idCircular']);
				redirect('/registros/circulares_activas/', 'refresh');
			}else{
				$mensaje = "No tiene acceso para desactivar circulares!";
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

   


//<--------------------------------------NO CONFORMIDADES ------------------->

    public function mis_noConformidades($param="")
    {
    	if ($this->session->has_userdata('usuario'))
        {
        	if (empty($param))
			    {
			    	$userId = $this->session->userdata('id');
			    	$data['noConformidades'] = $this->Registros_model->mis_noConformidades($userId);
			    	$data['empleados'] = $this->empleados_model->get_empleados_activos();
			    	$this->load->view('templates/head_compras');
		        	$this->load->view('templates/header_registros');
			    	$this->load->view('templates/aside', $this->session->userdata());
			    	$this->load->view('registros/mis_noConformidades',$data);
			    	$this->load->view('templates/footer');

			    }
			    elseif($param == "listado")
				{
					$idEmpleado = $userId = $this->session->userdata('id');
        			$tipo = $this->input->post('tipo');
        			$array['noConformidades'] = $this->Registros_model->list_no_conformidades_empleado($tipo,$idEmpleado);
	
				    print_r(json_encode($array['noConformidades']));
				}
				elseif($param == "imprimir")
				{
					$noConformidadId = $_GET['documentId'];
					$array['noConformidad'] = $this->Registros_model->get_noConformidad($noConformidadId);
					$this->load->view('registros/pdfnoConformidad',$array);
				}
    	}else
        {
        	 redirect('/secure/login', 'refresh');
        } 
    }

    public function no_conformidades($action="")
    {
    	if ($this->session->has_userdata('usuario'))
        {
        	$acceso_registros = $this->Secure_model->access(self::sector);
            

            if ($acceso_registros <= 3)
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
                redirect('/registros/mis_noConformidades', 'refresh');
            }


	    }else
        {
        	 redirect('/secure/login', 'refresh');
        }  

	}


	public function listado_noConformidades($param="")
	{
		if ($this->session->has_userdata('usuario'))
        {
        	$acceso_calidad = $this->Secure_model->access(self::sector);
        	if ($acceso_calidad <= 2)
            {
            	if (empty($param))
			    {
			    	$data['noConformidades'] = $this->Registros_model->list_no_conformidades();
			    	$data['empleados'] = $this->empleados_model->get_empleados_activos();
			    	$this->load->view('templates/head_compras');
		        	$this->load->view('templates/header_registros');
			    	$this->load->view('templates/aside', $this->session->userdata());
			    	$this->load->view('registros/listado_noConformidades',$data);
			    	$this->load->view('templates/footer');

			    }elseif($param == "listado")
				{
        			$tipo = $this->input->post('tipo');
        			$array['noConformidades'] = $this->Registros_model->list_no_conformidades($tipo);
						
				    print_r(json_encode($array['noConformidades']));

				}elseif($param == "listado_empleado")
				{
        			$userId = $this->input->post('userId');
        			$array['noConformidades'] = $this->Registros_model->empleado_no_conformidades($userId);
						
				    print_r(json_encode($array['noConformidades']));
				}elseif($param == "listado_estado")
				{
        			$estado = $this->input->post('estado');
        			$array['noConformidades'] = $this->Registros_model->list_no_conformidades_estado($estado);
						
				    print_r(json_encode($array['noConformidades']));
				}elseif($param == "imprimir")
				{
					$noConformidadId = $_GET['documentId'];
					$array['noConformidad'] = $this->Registros_model->get_noConformidad($noConformidadId);
					$this->load->view('registros/pdfnoConformidad',$array);
				}

            }else
			{
				$mensaje = "Usted no tiene acceso a este modulo!";
                echo ("<script>
                alert('".$mensaje."')</script>");
                redirect('/registros/mis_noConformidades', 'refresh');
			}



		}else
        {
        	 redirect('/secure/login', 'refresh');
        }  

	}

	public function editar_noConformidad($action="")

	{
		if ($this->session->has_userdata('usuario'))
        {
        	var_dump($_POST);
        	// $acceso_registros = $this->Secure_model->access(self::sector);

            // if ($acceso_registros <= 3)
            // {
	 		// 	if (empty($action))
	 		// 	{
	 				
	 		// 		$sector = $this->Registros_model->list_sectores();
	 		// 		$procesos = $this->Registros_model->list_procesos();
	 		// 		$data['empleados'] = $this->empleados_model->get_empleados_activos();
			// 		$data['sector'] = $sector;
			// 		$data['procesos'] = $procesos;
			// 		$noConformidadId = $this->input->post('select');
			// 		if (!empty($noConformidadId))
			// 		{
			// 			$data['noConformidad'] = $this->Registros_model->get_noConformidad($noConformidadId);
			//         	$this->load->view('templates/head_compras');
			//         	$this->load->view('templates/header_registros');
			//         	$this->load->view('templates/aside', $this->session->userdata());	
			// 	        $this->load->view('registros/editar_noConformidades',$data);
			// 	        $this->load->view('templates/footer');

			// 		}else
			// 		{
			// 			redirect('/registros/no_conformidades/', 'refresh');
			// 		}

	 		// 	}elseif ($action == "guardar")
	 		// 	{
	 		// 		$userId = $this->session->userdata('id');
	        // 		$today = date("Y-m-d H:i:s");
	 		// 		$array_noConformidad = array('ultimaAct' => $today,
	 		// 								'titulo' => $this->input->post('titulo'),
	 		// 								'descripcion' => $this->input->post('descripcion'),
	 		// 								'accionin' => $this->input->post('accion_inmediata'),
	 		// 								'ingreso' => $userId,
	 		// 								'empleado1' => $this->input->post('empleado1'),
	 		// 								'sector' => $this->input->post('sector'),
	 		// 								'proceso' => $this->input->post('proceso'),
	 		// 								'tipo' => $this->input->post('tipo'),
	 		// 								'causas' => $this->input->post('causas'),
	 		// 								'accionCorrectiva' => $this->input->post('accion_correctiva'),
	 		// 								'eficacia' => $this->input->post('eficacia'),
	 		// 								'estado' => $this->input->post('estado'));
	 		// 		$noConformidadId = $this->input->post('id_noConformidad');
	 		// 		$this->Registros_model->update_noConformidad($array_noConformidad,$noConformidadId);
	 		// 		redirect('/registros/listado_noConformidades/', 'refresh');
	 		// 	}elseif ($action == "print")
	 		// 	{
	 		// 		var_dump($_POST);
	 		// 	}else{
	 		// 		redirect('/registros/listado_noConformidades/', 'refresh');
	 		// 	}
	 		// }
        }else
        {
        	 redirect('/secure/login', 'refresh');
        }

	}

	public function ingresar_auditoria()
	{
		if ($this->session->has_userdata('usuario'))
        {
        	$data['empleados'] = $this->empleados_model->get_empleados_activos();
        	$data['procesos'] = $this->Registros_model->list_procesos();

        	$this->load->view('templates/head_compras');
        	$this->load->view('templates/header_registros');
        	$this->load->view('templates/aside', $this->session->userdata());	
	        $this->load->view('registros/ingresar_auditoria',$data);
	        $this->load->view('templates/footer');


		}else
        {
        	 redirect('/secure/login', 'refresh');
        }
	}

	public function pdf_noConformidad()
    {
    	var_dump($_POST);
	    //Circular to print
	    // $acceso_registros = $this->Secure_model->access(self::sector);
		// $data['estado'] = $this->input->post('iestado');
		// $data['action'] = $this->input->post('action');
		// $data['idCircular'] = $this->input->post('select');
		// if ($data['action'] == 'print')
		// {
		// 	if (($data['estado'] == "caducada") || ($data['estado'] == "revision") ){
		// 		$mensaje = "Por favor seleccione una circular activa!";
		// 		echo ("<script>
		// 		alert('".$mensaje."')</script>");
		// 		redirect('/registros/circulares_activas/', 'refresh');
		// 	}else
		// 	{
		// 		if (!empty($data['idCircular']))
		// 		{
		// 			$data['circular_selected'] = $this->Registros_model->get_circular($data['idCircular'])[0];//Fila
					
		// 			$this->load->view('registros/pdfCirculares',$data);
		// 		}else
		// 		{
		// 			//User didn´t select circular!	
		// 			$mensaje = "Por favor seleccione una circular!";
		// 			echo ("<script>
		// 			alert('".$mensaje."')</script>");
		// 			redirect('/registros/circulares_activas/', 'refresh');
		// 		}
		// 	}
		// }elseif ($data['action'] == 'activate')
		// {
        //     if ($acceso_registros <= 2)
        //     {
		// 	$this->Registros_model->activar_circular($data['idCircular']);
		// 	redirect('/registros/circulares_activas/', 'refresh');	
		// 	}else{
		// 		$mensaje = "No tiene acceso para activar circulares!";
		// 			echo ("<script>
		// 			alert('".$mensaje."')</script>");
		// 			redirect('/registros/circulares_activas/', 'refresh');
		// 	}
		// }elseif ($data['action'] == 'deactivate')
		// {
		// 	if ($acceso_registros <= 3)
        //     {
		// 		$this->Registros_model->anular_circular($data['idCircular']);
		// 		redirect('/registros/circulares_activas/', 'refresh');
		// 	}else{
		// 		$mensaje = "No tiene acceso para desactivar circulares!";
		// 			echo ("<script>
		// 			alert('".$mensaje."')</script>");
		// 			redirect('/registros/circulares_activas/', 'refresh');
		// 	}
		// }
		

  	}



// <-----------------------------REPORTES ------------------------------>
    
    public function nuevo_reporte($action="")
    {
		if ($this->session->has_userdata('usuario'))
        {
        	if (empty($action))
 			{

 				$data['empleados'] = $this->empleados_model->get_empleados_activos();
				$data['sector'] = $this->Registros_model->list_sectores();
				$data['procesos'] = $this->Registros_model->list_procesos();
	        	$this->load->view('templates/head_compras');
	        	$this->load->view('templates/header_registros');
	        	$this->load->view('templates/aside', $this->session->userdata());	
		        $this->load->view('registros/nuevo_reporte',$data);
		        $this->load->view('templates/footer');
 			}elseif ($action == "insertar")
 			{
 				$usuario = $this->session->userdata('id');
 				$today = date("Y-m-d H:i:s");
 				$nuevo_reporte = array(
 					'fecha' => $today,
	 				'usuario' => $usuario,		
					'titulo' => $this->input->post('titulo'),
					'proceso' => $this->input->post('proceso'),
					'empleado' => $this->input->post('involucrado'),
					'tipo' => $this->input->post('tipo'),
					'sector' => $this->input->post('sector'),
					'descripcion' => $this->input->post('descripcion'),
					'tarea' => $this->input->post('tarea'),
					'fechaAct' => $today);

 				$this->Registros_model->insert_reporte($nuevo_reporte);

 				unset($_POST);
                redirect('/registros/nuevo_reporte/', 'refresh');
 			}

    	}else
        {
        	 redirect('/secure/login', 'refresh');
        }  

    }

    public function listado_reportes($param='')
    {
    	if ($this->session->has_userdata('usuario'))
        {
        	$acceso_calidad = $this->Secure_model->access(self::sector);
        	if ($acceso_calidad <= 2)
            {
	        	if (empty($param))
			    {
			    	$data['empleados'] = $this->empleados_model->get_empleados_activos();
			    	
			    	$this->load->view('templates/head_compras');
		        	$this->load->view('templates/header_registros');
			    	$this->load->view('templates/aside', $this->session->userdata());
			    	$this->load->view('registros/listado_reportes',$data);
			    	$this->load->view('templates/footer');

			    }elseif($param == "listado")
				{

					$tipo = $this->input->post('tipoReporte');
					$array['reportes'] = $this->Registros_model->list_reportes($tipo);
						
				    print_r(json_encode($array['reportes']));

				}elseif($param == "listado_empleado")
				{
        			$nombre_empleado = $this->input->post('empleado');
        			$array['reportes'] = $this->Registros_model->listado_empleado_reportes($nombre_empleado);
						
				    print_r(json_encode($array['reportes']));
				}
			}else
			//Not RRHH access
			{
				if (empty($param))
			    {
			    	$data['empleados'] = $this->empleados_model->get_empleados_activos();
			    	
			    	$this->load->view('templates/head_compras');
		        	$this->load->view('templates/header_registros');
			    	$this->load->view('templates/aside', $this->session->userdata());
			    	$this->load->view('registros/listado_reportes_empleado',$data);
			    	$this->load->view('templates/footer');

			    }elseif($param == "listado")
				{
					$userName = $this->session->userdata('nombre');
					$tipo = $this->input->post('tipoReporte');
					$array['reportes'] = $this->Registros_model->list_reportes_empleado($tipo,$userName);
						
				    print_r(json_encode($array['reportes']));

				}
			}

        }else
        {
        	 redirect('/secure/login', 'refresh');
        } 
    }	

    public function pdfReportes()
    {
	    //Reportes to print

		$data['action'] = $this->input->post('print');
		$idReportes = $this->input->post('select');
		if (!empty($idReportes))
		{
			$reportes_id_array=implode(',', array_map('intval', $idReportes));
			$data['reportes'] = $this->Registros_model->get_reportes($reportes_id_array);
			$this->load->view('registros/pdfReportes',$data);
		}else
		{
			//User didn´t select any reporte!	
			$mensaje = "Por favor seleccione un reporte primero!";
			echo ("<script>
			alert('".$mensaje."')</script>");
			redirect('/registros/listado_reportes/', 'refresh');
		}		
		
  	}

  	public function nuevo_merito($action="")
    {
    	if ($this->session->has_userdata('usuario'))
        {
 			if (empty($action))
 			{
 				$sector = $this->Registros_model->list_sectores();
 				$procesos = $this->Registros_model->list_procesos();
 				$politicas = $this->Registros_model->list_politicas();
 				$data['empleados'] = $this->empleados_model->get_empleados_activos();
				$data['sector'] = $sector;
				$data['procesos'] = $procesos;
				$data['politicas'] = $politicas;
	        	$this->load->view('templates/head_compras');
	        	$this->load->view('templates/header_registros');
	        	$this->load->view('templates/aside', $this->session->userdata());	
		        $this->load->view('registros/nuevo_merito',$data);
		        $this->load->view('templates/footer');
 			}elseif ($action == "nuevo")
 			{
 				
 				$userId = $this->session->userdata('id');
 				$empleado = $this->input->post('empleado');
        		$today = date("Y-m-d H:i:s");
        		if ($userId != $empleado)
        		{
        			$array_merito = array('fecha' => $today,
 										'politica' => $this->input->post('politica'),
 										'logro' => $this->input->post('logro'),
 										'usuario' => $userId,
 										'empleado' => $empleado,
 										'sector' => $this->input->post('sector'),
 										'estado' => 'revision');
 				
	 				$this->Registros_model->insert_merito($array_merito);
	 				unset($_POST);
	                redirect('/registros/circulares/', 'refresh');
        		}else
        		{
        			$mensaje = "No puede generar un mérito para usted mismo!";
					echo ("<script>
					alert('".$mensaje."')</script>");
					redirect('/registros/circulares/', 'refresh');
        		}

 				
 			}


	    }else
        {
        	 redirect('/secure/login', 'refresh');
        }  

    }

	public function listado_meritos($param='')
    {
    	if ($this->session->has_userdata('usuario'))
        {
        	$acceso_calidad = $this->Secure_model->access(self::sector);
        	if ($acceso_calidad <= 2)
            {
	        	if (empty($param))
			    {
			    	$data['empleados'] = $this->empleados_model->get_empleados_activos();
			    	$data['meritos'] = $this->Registros_model->listado_meritos();
			    	$this->load->view('templates/head_compras');
		        	$this->load->view('templates/header_registros');
			    	$this->load->view('templates/aside', $this->session->userdata());
			    	$this->load->view('registros/listado_meritos',$data);
			    	$this->load->view('templates/footer');

			    }elseif($param == "listado")
				{
					$politica = $this->input->post('politicaMerito');
					$array['reportes'] = $this->Registros_model->listado_meritos($politica);
						
				    print_r(json_encode($array['reportes']));

				}elseif($param == "listado_empleado")
				{
        			$nombre_empleado = $this->input->post('empleado');
        			$array['reportes'] = $this->Registros_model->listado_empleado_reportes($nombre_empleado);
						
				    print_r(json_encode($array['reportes']));
				}
			}else
			//Not RRHH access
			{
				if (empty($param))
			    {
			    	$userId = $this->session->userdata('id');

			    	$data['meritos'] = $this->Registros_model->listado_meritos_empleado($userId);
			    	$this->load->view('templates/head_compras');
		        	$this->load->view('templates/header_registros');
			    	$this->load->view('templates/aside', $this->session->userdata());
			    	$this->load->view('registros/listado_meritos_empleado',$data);
			    	$this->load->view('templates/footer');

			    }elseif($param == "listado")
				{
					$userId = $this->session->userdata('id');
					$politica = $this->input->post('politicaMerito');
					$array['reportes'] = $this->Registros_model->listado_meritos_empleado($userId,$politica);
						
				    print_r(json_encode($array['reportes']));

				}
			}

        }else
        {
        	 redirect('/secure/login', 'refresh');
        } 
    }
//<--------------------------- ORDENES DE TRABAJO ------------------------>


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

   	
// INSERT BOARD NOTE ----------------------->
    public function insert_task()
    {
        if ($this->session->has_userdata('usuario'))
        {    
            if( isset($_POST['nota'])){$note = $_POST['nota'];}

            if (!empty($note)){
                $this->Novedades_model->insert_board($note);
                redirect('/pages/index', 'refresh');
            }else{
                $board = $this->Novedades_model->get_board();
                $data['board'] = $board;
                $data['title'] = $page;
                $this->load->view('templates/head', $data);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $this->session->userdata());
                $this->load->view('pages/home', $data);
                $this->load->view('templates/footer', $data);
            }

        }else{
             redirect('/secure/login', 'refresh');
        }
    }


}


?>