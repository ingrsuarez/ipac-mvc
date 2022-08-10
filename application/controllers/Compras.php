<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras extends CI_Controller {

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
	const sector = "2";

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Compras_model');
        $this->load->model('Secure_model');
        $this->load->model('empleados_model');
        $this->load->helper('url_helper');

    }

    public function pedidos($value='')
    {
    	if ($this->session->has_userdata('usuario'))
        {

        	$pedidos = $this->Compras_model->get_pedidos();
        	$data['pedidos'] = $pedidos;
        	$data['misPedidos'] = "";
        	$this->load->view('templates/head');
        	$this->load->view('templates/header_compras');
        	$this->load->view('templates/aside', $this->session->userdata());
        	$this->load->view('compras/pedidos',$data);
        	$this->load->view('templates/footer');
        }else
        {
        	 redirect('/secure/login', 'refresh');
        }
    }

    public function mis_pedidos($value='')
    {
    	if ($this->session->has_userdata('usuario'))
        {
        	$this->session->set_userdata('last_page', 'editar_pedidos');
        	$user = $this->session->userdata('usuario');
        	$pedidos = $this->Compras_model->get_mispedidos($user);
        	$data['pedidos'] = $pedidos;
        	$data['misPedidos'] = "checked";
        	$this->load->view('templates/head');
        	$this->load->view('templates/header_compras');
        	$this->load->view('templates/aside', $this->session->userdata());
        	$this->load->view('compras/pedidos',$data);
        	$this->load->view('templates/footer');
        }else
        {
        	 redirect('/secure/login', 'refresh');
        }
    }

    public function editar_pedidos()
    {
    	if ($this->session->has_userdata('usuario'))
        {
        	$this->session->set_userdata('last_page', 'editar_pedidos');
        	$access = $this->session->userdata('puesto');
        	$delete = $this->input->post('delete');
        	$user = $this->session->userdata('usuario');
        	$pedidos = $this->Compras_model->pedidos_pendientes($user);
        	$data['pedidos'] = $pedidos;
        	$data['misPedidos'] = "";
        	$data['btn_anular'] = "";
        	$this->load->view('templates/head');
        	$this->load->view('templates/header_compras');
        	$this->load->view('templates/aside', $this->session->userdata());
        	$this->load->view('compras/editar_pedidos',$data);
        	$this->load->view('templates/footer');
        	
        }else
        {
        	 redirect('/secure/login', 'refresh');
        }
    }

    public function editar_pedido()
    {
    	if ($this->session->has_userdata('usuario'))
        {	
        	$lastPage = $this->session->userdata('last_page');
        	$access =  (int)$this->Secure_model->access(self::sector)['acceso'];
        	$edit = $this->input->post('articulo')[0];
        	$id = $this->input->post('pedido')[0];
        	//User has access to edit
        	if (!empty($access) && $access <= 2){

        		$this->Compras_model->editar_pedido($edit,$id);
        		redirect('/compras/'.$lastPage, 'refresh');
        	}else{redirect('/compras/pedidos', 'refresh');}
        	
        }else
        {	//No session started
        	 redirect('/secure/login', 'refresh');
        }
    }

    public function anular_pedido()
    {
    	if ($this->session->has_userdata('usuario'))
        {
        	$lastPage = $this->session->userdata('last_page');
        	$access = (int) $this->Secure_model->access(self::sector);
        	$edit = $this->input->post('delete');
        	
        	//User has access to edit
        	if (!empty($access) && $access <= 2){
        		$this->Compras_model->anular_pedido("anulado",$edit);
        		redirect('/compras/'.$lastPage, 'refresh');
        	}
        	
        }else
        {	//No session started
        	 redirect('/secure/login', 'refresh');
        }
    }



    public function insertar_pedido($id='')
    {
    	$data['icheck'] = $this->input->post('iCheck');
    	if ($data['icheck'])
    	{
	    	$data['sector'] = $this->input->post('sector');
	    	$data['articulo'] = $this->input->post('articulo_pedido');
	    	$data['id'] = $this->session->userdata('id');
	    	$data['username'] = $this->session->userdata('usuario');
	    	if ($this->session->has_userdata('usuario'))
	        {
	        	$this->Compras_model->insert_pedido($data);
	        	redirect('/compras/pedidos', 'refresh');
	        }else
	        {
	        	 redirect('/secure/login', 'refresh');
	        }
	    }else{redirect('/compras/pedidos', 'refresh');}
    }

    public function confeccionarOC($success="")
    {
    	if ($this->session->has_userdata('usuario'))
	        {	
	        	if ($success == 1){
	        		$data['mensaje'] = "Success: ".$success;
	        		$this->load->view('templates/mensaje',$data);
	        	}
	        	$this->session->set_userdata('last_page', 'confeccionarOC');
	        	$access = (int) $this->Secure_model->access(self::sector);
	        	$data['id'] = $this->session->userdata('id');
	        	$user = $this->session->userdata('usuario');
	        	$pedidos = $this->Compras_model->pedidos_equivalentes($user);
	        	$data['pedidos'] = $pedidos;

	        	$proveedores = $this->Compras_model->list_proveedores();
	        	$data['proveedores'] = $proveedores;
	        	$this->load->view('templates/head');
	        	$this->load->view('templates/header_compras');
	        	$this->load->view('templates/aside', $this->session->userdata());
	        	$this->load->view('compras/confeccionar_OC',$data);
	        	$this->load->view('templates/footer');

			}else
	        {
	        	 redirect('/secure/login', 'refresh');
	        }

    }

    public function generar_OC()
    {
    	if ($this->session->has_userdata('usuario'))
	        {        	
	        	$this->session->set_userdata('last_page', 'confeccionarOC');
	        	$access = (int) $this->Secure_model->access(self::sector);
	        	$data['articulo'] = $this->input->post('articulo');
	    		$data['pedido'] = $this->input->post('pedido');
	    		$data['cantidad'] = $this->input->post('cantidad');
	    		$data['check'] = $this->input->post('OC_check');
	    		$proveedor = $this->input->post('proveedor');//supplier
	    		$user_id = $this->session->userdata('id');
	    		$numero = date("y").date("m").date("d").$user_id.$proveedor;//Purchase order number
	    		$today = date("Y-m-d H:i:s");
	    		$data['button'] = $this->input->post('boton'); 

	    		if (!empty($data['check']))
	    		{
	    			$list = array_intersect($data['pedido'],$data['check']);
	    			$cantidad = array_intersect_key($data['cantidad'],$list);
		    		$articulos = array_intersect_key($data['articulo'],$list);
		    		if ($data['button'] == 'Generar Orden'){

			    		foreach ($articulos as $key => $id )
			    		{
			    			$nombre = $this->Compras_model->nombre_articulo($id);
			    			$estaPedido = $this->Compras_model->esta_pedido($id,$proveedor);
			    			
			    			//If the item its pending from supplier
			    			if (!empty($estaPedido)){
			    				//If the item its pending from selected supplier
			    				$mensaje = "Ya hay ".$estaPedido['cantidad']." ".$estaPedido['descripcion']." pedida para este proveedor!";
					    		echo ("<script>
					    		alert('".$mensaje."')</script>");
			    			}

			    			$insertOC = array('numero'=>$numero,'fecha'=>$today,'articulo'=>$articulos[$key],'pedido'=>$data['pedido'][$key],'cantidad'=>$cantidad[$key],'proveedor'=>$proveedor,'descripcion'=>$nombre['nombre']);
			    			
			    			$this->Compras_model->insert_OC($insertOC);
			    			
			    		}
			    		redirect('/compras/confeccionarOC', 'refresh');
		    		}elseif ($data['button'] == 'Anular') {

		    			foreach ($list as $key => $id) {
		    				
			    			$this->Compras_model->anular_pedido("anulado",$list[$key]);
			    			
			    		}
			    		redirect('/compras/confeccionarOC', 'refresh');
		    		}
		    	}else{
		    		$data['mensaje'] = "Debe seleccionar al menos un item para generar la Orden de Compra!";
		    		$data['location'] = "/compras/confeccionarOC";
		    		$this->load->view('templates/mensaje',$data);
		    		
		    	}
		    }else
	        {
	        	 redirect('/secure/login', 'refresh');
	        }
    }

    public function imprimirOC($param="")
    {
    	if ($this->session->has_userdata('usuario'))
	        { 
		        if (empty($param))
		        {
		    		

			    	$proveedores = $this->Compras_model->list_proveedores();
				    $data['proveedores'] = $proveedores;
			    	$this->load->view('templates/head');
			    	$this->load->view('templates/header_compras');
			    	$this->load->view('templates/aside', $this->session->userdata());
			    	$this->load->view('compras/imprimir_OC',$data);

			    	$this->load->view('templates/footer');

			    	
				}elseif ($param == "ocPendientes")
			    {
			    	$idProveedor = $this->input->post('iproveedor');	 
					// $idProveedor = 1;
					$array = $this->Compras_model->oc_pendientes($idProveedor);
					
			    	echo (json_encode($array[0]));
			    	
			    	// $proveedores = $this->Compras_model->list_proveedores();
				    // $data['proveedores'] = $proveedores;
			    	// $this->load->view('templates/head');
			    	// $this->load->view('templates/header_compras');
			    	// $this->load->view('templates/aside', $this->session->userdata());
			    	// $this->load->view('compras/imprimir_OC',$data);
			    	// $this->load->view('templates/footer');
		    	}
	    }else
	        {
	        	 redirect('/secure/login', 'refresh');
	        }



    }

    public function ocPendientes()
    {

  //   	if (!empty($_POST['iproveedor'])){
		// $idProveedor = $_POST['iproveedor'];
		// $enlace = new mysqli("127.0.0.1", "u540644031_suarroda", "Ipac2021", "u540644031_GestionIpac", 3306);	 
		// $query = "SELECT * FROM `ocpendientes` WHERE proveedor = '".$idProveedor."' ORDER BY `numero`";
		// $resultado = mysqli_query($enlace,$query);			 
		// $cont = 0; 
		// $data = array();
		// while ($row = mysqli_fetch_assoc($resultado)) {
		// 	$data[$cont] = $row;
		// 	$cont++;
		// }
		$data = array("Peter"=>35, "Ben"=>37, "Joe"=>43);
		echo $data;
	

    }





}


?>