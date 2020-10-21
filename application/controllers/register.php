<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	 
	class Register extends CI_Controller {
	
		public function __construct()
		{
			parent::__construct();
			$this->load->helper('url','form');
			$this->load->database();
			$this->load->model('registermodel');
			$this->load->library('form_validation');
			$this->load->library('session');
		}
	
		public function index()
		{
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('nama_user', 'Nama_user', 'trim|required');
			$this->form_validation->set_rules('no_telpon', 'No_telpon', 'trim|required');
			
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('aceadmin/registerview');
			}
			else
			{
					$config['upload_path'] = './images/user/';
					$config['allowed_types'] = 'jpg|png|jpeg';
	   				$config['max_size']  = '2048';
	    			$config['remove_space'] = TRUE; 

					$this->load->library('upload', $config);
	    			if (!$this->upload->do_upload('photo')) //jika gagal upload
	    			{

   					$senddata['usernamenew']=$this->input->post('username');
					$senddata['passwordnew']=$this->input->post('password');
					$senddata['namausernew']=$this->input->post('nama_user');
					$senddata['jurusannew']=$this->input->post('jurusan');
					$senddata['asalnew']=$this->input->post('asal');
					$senddata['notelponnew']=$this->input->post('no_telpon');
					$senddata['emailnew']=$this->input->post('email');
					$senddata['laporannew']='belum upload';
					$senddata['levelnew']='calon';

					$back['jumlah']=$this->registermodel->adduser($senddata);
					// $back['array']=$this->registermodel->readuser();
					//$this->load->view('register',$back);
					$pesan = "The User Success Register";
					$this->session->set_flashdata('msg', $pesan);
					redirect('controllerlogin/index');
					}
					else
					{

					$file =array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
					$senddata['photonew']=$file['file']['file_name'];
					$senddata['usernamenew']=$this->input->post('username');
					$senddata['passwordnew']=$this->input->post('password');
					$senddata['namausernew']=$this->input->post('nama_user');
					$senddata['jurusannew']=$this->input->post('jurusan');
					$senddata['asalnew']=$this->input->post('asal');
					$senddata['notelponnew']=$this->input->post('no_telpon');
					$senddata['emailnew']=$this->input->post('email');
					$senddata['laporannew']='belum upload';
					$senddata['levelnew']='calon';

					$back['jumlah']=$this->registermodel->adduserwithphoto($senddata);

					// $back['array']=$this->registermodel->readuser();
					//$this->load->view('register',$back);
					$pesan = "The User Success Register";
					$this->session->set_flashdata('msg', $pesan);
					redirect('controllerlogin/index');
					}

   				
			}				
		}
	}
	/* End of file admin.php */
	/* Location: ./application/controllers/admin.php */
?>