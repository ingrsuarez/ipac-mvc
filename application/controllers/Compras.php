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
    public function insertar_pedido($id='')
    {
    	$data['icheck'] = $this->input->post('iCheck');
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
    }
}


?>