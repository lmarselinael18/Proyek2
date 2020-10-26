<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Writer extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->helper('url','form');
			$this->load->database();
			$this->load->model('writermodel');
			$this->load->library('form_validation');
			$this->load->library('session');
		}
	 
		public function index() 
		{
			if ($this->session->userdata('logged_in'))
			{
				$datanews['news']=$this->writermodel->readpemesanan($this->session->userdata('UID'));
				$datauser['user']=$this->session->userData();
				$datanews['divisi']=$this->writermodel->readdivisi();
				$this->load->view('aceuser/headerpen', $datauser);
				$this->load->view('aceuser/datapemesanan', $datanews);
			}
			else
			{
				$this->session->set_flashdata('msg', 'You Must SIGN IN To Access The Writer Page!!');
				redirect('controllerlogin/index');
			}
        }
    }
    ?>