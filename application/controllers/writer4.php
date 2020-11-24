<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class writer4 extends CI_Controller {

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
				$this->load->view('aceuser-tolak/headerpen', $datauser); 
				$this->load->view('aceuser-tolak/datapemesanan', $datanews);
			}
			else
			{
				$this->session->set_flashdata('msg', 'You Must SIGN IN To Access The Writer Page!!');
				redirect('controllerlogin/index');
			}
		}

	
		public function edituser($indexdata)
		{
			if ($this->session->userdata('logged_in'))
			{
				$this->form_validation->set_rules('up_username', 'Username', 'trim|required');
				$this->form_validation->set_rules('up_password', 'Password', 'trim|required');
				$this->form_validation->set_rules('up_nama_user', 'Name', 'trim|required');
				$this->form_validation->set_rules('up_jurusan', 'Jurusan', 'trim|required');
				$this->form_validation->set_rules('up_no_telpon', 'Nomer Telpon', 'trim|required');
		
				if($this->form_validation->run()==FALSE)
				{
					$datauser['user']=$this->writermodel->readuser_index($indexdata);
					$this->load->view('aceuser-tolak/editprofil', $datauser);
				}
				else 
				{
					$config['upload_path'] = './images/user/';
					$config['allowed_types'] = 'jpg|png|jpeg';
		   			$config['max_size']  = '2048';
		    		$config['remove_space'] = TRUE;

		    		$this->load->library('upload', $config);
		    		if (!$this->upload->do_upload('up_photo')) //jika gagal upload
		    		{
						$krm['username_up']=$this->input->post('up_username');
						$krm['password_up']=$this->input->post('up_password');
						$krm['nama_user_up']=$this->input->post('up_nama_user');
						$krm['jurusan_up']=$this->input->post('up_jurusan');
						$krm['asal_up']=$this->input->post('up_asal');
						$krm['no_telpon_up']=$this->input->post('up_no_telpon');
						$krm['email_up']=$this->input->post('up_email');
						// $krm['laporan_up']='belum upload';
						$krm['index']=$indexdata;
										
						$kembali['jumlah']=$this->writermodel->editusernophotos($krm);

						$userr=$this->writermodel->readuser_index($indexdata);
				
						$userData = array( 
	        			'username' => $userr->username,
	        			'password' => $userr->password,
	        			'nama_user' => $userr->nama_user,
	        			'jurusan' => $userr->jurusan,
	        			'asal' => $userr->asal,
	        			'no_telpon' => $userr->no_telpon,
	        			'email' => $userr->email, 			
	        			'photo' => $userr->photo,
	        			'level' => $userr->level,
	        			'UID' => $userr->UID,   
	        			'logged_in' => TRUE
	      				);
	      				$this->session->set_userdata($userData);
	      				$pesan = "Profil berhasil diperbarui";
			
						//$this->session->set_flashdata('msg', $pesan);
						$datauser['user']=$this->session->set_flashdata('msg', $pesan);
						$datauser['user']=$this->writermodel->readuser_index($indexdata);
						$this->load->view('aceuser-tolak/editprofil', $datauser);
						
						
						// $back['news']=$this->writermodel->readpemesanan($this->session->userdata('UID'));
						// $datauser['user']=$this->session->userData();
						// $this->load->view('headerpen2', $datauser);
						// $this->load->view('datanews', $back);
		    		}
		    		else
		    		{
		    			$file =array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');

						$krm['photo_up']=$file['file']['file_name'];
						$krm['username_up']=$this->input->post('up_username');
						$krm['password_up']=$this->input->post('up_password');
						$krm['nama_user_up']=$this->input->post('up_nama_user');
						$krm['jurusan_up']=$this->input->post('up_jurusan');
						$krm['asal_up']=$this->input->post('up_asal');
						$krm['no_telpon_up']=$this->input->post('up_no_telpon');
						$krm['email_up']=$this->input->post('up_email');
						// $krm['laporan_up']='belum upload';
						$krm['index']=$indexdata;
										
						$kembali['jumlah']=$this->writermodel->edituser($krm);

						$userr=$this->writermodel->readuser_index($indexdata);
				
						$userData = array(
	        			'username' => $userr->username,
	        			'password' => $userr->password,
	        			'nama_user' => $userr->nama_user,
	        			'jurusan' => $userr->jurusan,
	        			'asal' => $userr->asal,
	        			'no_telpon' => $userr->no_telpon,
	        			'email' => $userr->email, 			
	        			'photo' => $userr->photo,
	        			'level' => $userr->level,
	        			'UID' => $userr->UID,   
	        			'logged_in' => TRUE
	      				);
	      				$this->session->set_userdata($userData);
	      				$pesan = "Profil berhasil diperbarui";
			
						//$this->session->set_flashdata('msg', $pesan);
						
						$datauser['user']=$this->session->set_flashdata('msg', $pesan);
						$datauser['user']=$this->writermodel->readuser_index($indexdata);
						$this->load->view('aceuser-tolak/editprofil', $datauser);

						// $back['news']=$this->writermodel->readpemesanan($this->session->userdata('UID'));
						// $datauser['user']=$this->session->userData();
						// $this->load->view('headerpen2', $datauser);
						// $this->load->view('datanews', $back);
					}
				}
			}
			else
			{
				$this->session->set_flashdata('msg', 'You Must SIGN IN To Access This Page!!');
				redirect('controllerlogin/index');
			}
		}
	
	}
	
	/* End of file writer.php */
	/* Location: ./application/controllers/writer.php */
?>