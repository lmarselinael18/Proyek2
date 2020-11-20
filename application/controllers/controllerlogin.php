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
	
	public function cekAkun(){
		//load model_login
		$this->load->model('model_login');

		//membuat validasi login
		$username = $this->input->post('input_username');
		$password = $this->input->post('input_password');

		$query = $this->model_login->cekAkun($username, $password);

		if($query === 1 || $query === 2)
		{
			$this->session->set_flashdata('msg','Username atau password salah');
			redirect('controllerlogin/index');
		}
		else
		{
			return TRUE;
		}
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
	          		redirect('admin/index');
	        	}
	        	else if($this->session->userdata('level') == 'superuser')
	        	{
	        		redirect('admin2/index');
	        	}
	        	else if($this->session->userdata('level') == 'calon')
	        	{
	        		redirect('writer/index');
	        	}
	        	else if($this->session->userdata('level') == 'peserta')
	        	{
	        		redirect('writer2/index');
	        	}
	        	else if($this->session->userdata('level') == 'pending')
	        	{
	        		redirect('writer3/index');
	        	}
	        	else if($this->session->userdata('level') == 'Tolak')
	        	{
	        		redirect('writer4/index');
	        	}
	    	}
	    	//Jika bernilai FALSE maka tampilkan error
	    	else
	    	{
	       		$data['error'] = $error;
	        	$this->load->view('aceadmin/loginview', $data);
	    	}
	    }
	    //Jika tidak maka alihkan kembali ke halaman login
	    else
	    {
	    	$this->load->view('aceadmin/loginview');
	    }
  	}

  	public function logout()
  	{
    	//Menghapus semua session (sesi)
    	$this->session->sess_destroy();
    	redirect('controllerlogin/index');
  	}
}
	?>