<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procedimientos extends CI_Controller {

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
        $this->load->helper('download');
        $this->load->model('Secure_model');
        $this->load->model('empleados_model');
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
	        $fname = str_replace(' ', '_', $this->uri->segment(4));
	        $tofile= base_url('/procedimientos/'.$sector.'/'.$fname);
	        
	        header('Content-Type: application/pdf');
	        readfile($tofile);
	    }else
        {
        	 redirect('/secure/login', 'refresh');
        }    
    }

    public function instructivos($fname="")
    {
    	if ($this->session->has_userdata('usuario'))
        {
        	if (empty($fname))
        	{
	        	$data['datos'] = "";
	        	$this->load->view('templates/head');
	        	$this->load->view('templates/header_instructivos');
	        	$this->load->view('templates/aside', $this->session->userdata());	
		        $this->load->view('procedimientos/instructivos_sistema');
		        $this->load->view('templates/footer');
		    }else
		    {
		    	
		    	$this->viewfile();
		    }
	    }else
        {
        	 redirect('/secure/login', 'refresh');
        }  


    }

    public function calculos()
    {
    	if ($this->session->has_userdata('usuario'))
        {
        	$data['datos'] = "";
        	$this->load->view('templates/head');
        	$this->load->view('templates/header_instructivos');
        	$this->load->view('templates/aside', $this->session->userdata());	
	        $this->load->view('procedimientos/calculos');
	        $this->load->view('templates/footer');

        }else
        {
        	 redirect('/secure/login', 'refresh');
        }  
    }
   
}


?>