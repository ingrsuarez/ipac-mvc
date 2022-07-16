<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Secure extends CI_Controller {

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


    }


    public function login($page="login"){
    	 $data['title'] = $page;
        if ($this->session->has_userdata('usuario'))
        {
            redirect('/pages/index', 'refresh');
        }else {
            $this->load->view('templates/head', $data);
            $this->load->view('secure/login');
            $this->load->view('templates/footer', $data);

        }
    }

    public function logout()
    {
    	
    	$this->session->sess_destroy();
    	redirect('/secure/login', 'refresh');
    }


}