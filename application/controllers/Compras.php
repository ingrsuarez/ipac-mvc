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
        	$access = $this->session->userdata('puesto');
        	$delete = $this->input->post('delete');
        	$user = $this->session->userdata('usuario');
        	$pedidos = $this->Compras_model->editar_pedidos($user);
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
        	$access =  (int)$this->Secure_model->access(self::sector)['acceso'];

        	$edit = $this->input->post('articulo')[0];
        	$id = $this->input->post('pedido')[0];
        	//User has access to edit
        	if (!empty($access) && $access <= 2){

        		$this->Compras_model->editar_pedido($edit,$id);
        		redirect('/compras/pedidos', 'refresh');
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
        	$access = (int) $this->Secure_model->access(self::sector);
        	$edit = $this->input->post('delete');
        	//User has access to edit
        	if (!empty($access) && $access <= 2){

        		$this->Compras_model->anular_pedido("anulado",$edit);
        		redirect('/compras/editar_pedidos', 'refresh');
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
}


?>