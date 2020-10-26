<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Controllerlogin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->load->model('model_login');
		$this->load->library('encryption');
		$this->load->model('dbquery');
    }
    
    public function index()
	{
		$this->login();
    }

    public function login()
	{
	    //proses login dan validasi nya
	    if ($this->input->post('submit'))
	    {
	   		$this->load->model('model_login');
	   		$this->form_validation->set_rules('input_username', 'Username', 'required');
	   		$this->form_validation->set_rules('input_password', 'Password', 'required');
	   		$error = $this->cekAkun();

	      	if ($this->form_validation->run() && $error === TRUE)
	      	{
	        	$username = $this->input->post('input_username');
	        	$password = $this->input->post('input_password');
	        	$data = $this->model_login->cekAkun($username, $password);

	        	//redirect('writer/index');
	
	        	//jika bernilai TRUE maka alihkan halaman sesuai dengan jenisuser nya
	        	if($this->session->userdata('level') == 'admin')
	        	{
	          		redirect('aceadmin/loginview');
                }
                else if($this->session->userdata('level') == 'calon')
	        	{
	        		redirect('aceadmin/index');
	        	}
	        	else if($this->session->userdata('level') == 'peserta')
	        	{
	        		redirect('aceadmin/index');
	        	}
	        	else if($this->session->userdata('level') == 'pending')
	        	{
	        		redirect('aceadmin/index');
	        	}
	        	else if($this->session->userdata('level') == 'Tolak')
	        	{
	        		redirect('aceadmin/index');
	        	}
                else
	    	{
	       		$data['error'] = $error;
                $this->load->view('aceadmin/loginview', $data);
            }
            
        }
    }
    else
	    {
	    	$this->load->view('aceadmin/loginview');
	    }
}
    
}
    ?>