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
        	$pedidos = $this->Compras_model->pedidos_pendientes();
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
	    	// var_dump($data['articulo']);
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

    public function recibirOC($param="")
    {
    	if ($this->session->has_userdata('usuario'))
	        { 
	        	$userId = $this->session->userdata('id');
	        	$items = $this->input->post('ocselect');
		        if (empty($param))
		        {	
		        	if (empty($items))
		        	{
				    	$proveedores = $this->Compras_model->list_proveedores();
					    $data['proveedores'] = $proveedores;
				    	$this->load->view('templates/head');
				    	$this->load->view('templates/header_compras');
				    	$this->load->view('templates/aside', $this->session->userdata());
				    	$this->load->view('compras/recibir_OC',$data);
				    	$this->load->view('templates/footer');
			    	}else
			    	{
			    		$data['ocselect'] = $this->input->post('ocselect');
	    				$data['pedido'] = $this->input->post('pedido');
	    				$data['articulo'] = $this->input->post('articulo');
	    				$data['ocnumber'] = $this->input->post('ocnumber');
	    				$data['cantidad'] = $this->input->post('cantidad');
	    				$data['lote'] = $this->input->post('lote');
	    				$data['vencimiento'] = $this->input->post('vencimiento');
	    				$remito = "R".($this->input->post('first'))."-".($this->input->post('last'));
	    				$proveedor = $this->input->post('iproveedor');
	    				$fecha = $this->input->post('fecha');
			    		$pedido = array_intersect($data['pedido'],$data['ocselect']);
			    		$OCnumber = array_intersect_key($data['ocnumber'],$pedido);
			    		$articulo = array_intersect_key($data['articulo'],$pedido);	
			    		$recibido = array_intersect_key($data['cantidad'],$pedido);	
			    		$lote = array_intersect_key($data['lote'],$pedido);
			    		$vencimiento = array_intersect_key($data['vencimiento'],$pedido);
			    		$this->Compras_model->recibir_OC($OCnumber,$recibido,$userId,$articulo,$pedido,$lote,$vencimiento,$proveedor,$remito,$fecha);
			    		redirect('/compras/recibirOC/', 'refresh');

			    	}
			    	
				}elseif ($param == "ocPendientes")
			    {
			    	$idProveedor = $this->input->post('iproveedor');	 
					// $idProveedor = 1;
					$array['pendientes'] = $this->Compras_model->pendientes_proveedor($idProveedor);
					
			    	print_r(json_encode($array['pendientes']));

		    	}
	    }else
	        {
	        	 redirect('/secure/login', 'refresh');
	        }

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
					$array['pendientes'] = $this->Compras_model->oc_pendientes($idProveedor);
					
			    	print_r(json_encode($array['pendientes']));
			    	// $this->load->view('compras/test',$array);
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

     public function pdfoc()
    {


    	// var_dump($_POST);
	    //Proveedor
		$data['idprov'] = $this->input->post('iproveedor');
		

		if (!empty($data['idprov']))
		{
			$data['numero'] = $this->input->post('ocselect');
			$ocNumber = $this->input->post('ocselect');
			if (!empty($ocNumber))
			{
				$data['items'] = $this->Compras_model->oc_items($ocNumber);//Fila
				//Send selected proveedor
				$data['filaprov'] = $this->Compras_model->select_proveedor($data['idprov']);
				// var_dump($data['filaprov']);
				$this->load->view('compras/pdfoc',$data);
			}else
			{
				//User didn´t select order!	
				$mensaje = "Por favor seleccione una orden de compra!";
	    		echo ("<script>
	    		alert('".$mensaje."')</script>");
	    		redirect('/compras/imprimirOC/', 'refresh');
			}
		}else
		{
			//User didn´t select supplier!	
			$mensaje = "Por favor seleccione un proveedor!";
    		echo ("<script>
    		alert('".$mensaje."')</script>");
    		redirect('/compras/imprimirOC/', 'refresh');
		}
    }



}


?>