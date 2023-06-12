<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

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
        $this->load->model('empleados_model');
        $this->load->model('Novedades_model');
        $this->load->model('Secure_model');
        $this->load->helper('url_helper');

    }


	public function index($page = 'home',$empleado = array())
	{
        
		 if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
        $data['title'] = $page;
        
        if ($this->session->has_userdata('usuario'))
        {
            $board = $this->Novedades_model->get_board();
            $data['board'] = $board;
            $data['username'] = $this->session->userdata('usuario');
            
            $this->load->view('templates/head', $data);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/aside', $this->session->userdata());
            $this->load->view('pages/home', $this->session->userdata());
            $this->load->view('templates/footer', $data);
        }else {
            $mensaje = "Por favor introduzca un usuario y contraseña correctos!";
                echo ("<script>
                alert('".$mensaje."')</script>");
            redirect('/secure/login', 'refresh');
        }
        $user = $this->input->post('username');
        $userPassword = $this->input->post('password');
        $newdata = array(
        'userName'  => $user,
        'password'  => md5($userPassword));
        $newUser = $this->Secure_model->check_password($newdata);
        ($newUser != false ? $this->session->set_userdata($newUser) : false);
	}



    public function view_empleado($id = NULL)
    {
        $data['empleados_item'] = $this->empleados_model->get_empleado(FALSE);
        $data['title'] = 'Empleados archive';
        $this->load->view('templates/header', $data);
        $this->load->view('pages/empleados', $data);
        $this->load->view('templates/footer', $data);
        $this->load->helper('form');
       
    }

    //Function to verify board tasks
    public function verify_task($page = 'home')
    {
        if ($this->session->has_userdata('usuario'))
        {
            $taskId = $this->input->post('vid');

            $this->Novedades_model->set_board($taskId,'estado','verificado');
            $board = $this->Novedades_model->get_board();
            
            $data['board'] = $board;
            $data['title'] = $page;
            $this->load->view('templates/head', $data);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/aside', $this->session->userdata());
            $this->load->view('pages/home', $data);
            $this->load->view('templates/footer', $data);
        }else
        {
            redirect('/secure/login', 'refresh');
        }
    }

    public function insert_task($page = 'home')
    {
        if ($this->session->has_userdata('usuario'))
        {    
            if( isset($_POST['nota'])){
                $note = $_POST['nota'];
                $sector = $_POST['sector'];
            }

            if (!empty($note)){
                $this->Novedades_model->insert_board($note,$sector);
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



    // Private methods

    

}
