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
		
		public function createnews()
		{
			if ($this->session->userdata('logged_in'))
			{
				if ($this->session->userdata('level') == 'calon')
				{

				$this->form_validation->set_rules('Jumlah_peserta', 'Jumlah Pemesanan', 'trim|required');
				$this->form_validation->set_rules('tgl_mulai', 'tgl Mulai', 'trim|required');
				$this->form_validation->set_rules('tgl_selesai', 'tgl Selesai', 'trim|required');
				
				if($this->form_validation->run() == FALSE)	{
					$datanews['news']=$this->writermodel->readdivisi();
					$this->load->view('aceuser/pesan',$datanews);
					
				}
				else
				{
				 	$config['upload_path'] = './images/news/';
					$config['allowed_types'] = 'doc|docx|pdf';
	   				$config['max_size']  = '2048';
	    			$config['remove_space'] = TRUE;

	    			$this->load->library('upload', $config);
	    			if (!$this->upload->do_upload('srt_pengantar')) //jika gagal upload
	    			{
	    				// $error = array('error' => $this->upload->display_errors()); //tampilkan error

	    				$pesan = "Gagal Pemesanan !!! , Cek file type tidak sesuai atau file size melebihi 2 MB ";
						
						$datanews['pesan']=$this->session->set_flashdata('msg1', $pesan);
						$datanews['news']=$this->writermodel->readdivisi();
			       		$this->load->view('aceuser/pesan', $datanews);
	    			}
	    			else

	    			{
	    			$file =array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');

	    				$senddata['srt_pengantar']=$file['file']['file_name'];
	    				$senddata['id_divisi']=$this->input->post('id_divisi');
						$senddata['UID']=$this->session->userdata('UID');
						$senddata['jml_pkl']=$this->input->post('Jumlah_peserta');
						$senddata['tgl_mulai']=$this->input->post('tgl_mulai');
						$senddata['tgl_selesai']=$this->input->post('tgl_selesai');
						$senddata['status']="Pendaftar";


		
						$back['jumlah']=$this->writermodel->pemesanan2($senddata);

						$level['level']="pending";
						$level['index']=$this->session->userdata('UID');

						$kirim['level1']=$this->writermodel->editlevel($level);
						
						
						
						$pesan = "Pemesanan anda sukses dipesan";
		
						$datanews['pesan']=$this->session->set_flashdata('msg', $pesan);
						$datanews['news']=$this->writermodel->readpemesanan($this->session->userdata('UID'));
						$datauser['user']=$this->session->userData();
						$datanews['divisi']=$this->writermodel->readdivisi();

						$userr=$this->writermodel->readuser_index($this->session->userdata('UID'));
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

						$this->load->view('aceuser-pending/headerpen', $datauser);
						$this->load->view('aceuser-pending/datapemesanan', $datanews);

						//redirect('writer/index');
	    				}	
					}
				}
				else
				{
					
					redirect('controllerlogin/index');
				}
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
					$this->load->view('aceuser/editprofil', $datauser);
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
			
						$datauser['user']=$this->session->set_flashdata('msg', $pesan);
						$datauser['user']=$this->writermodel->readuser_index($indexdata);
						$this->load->view('aceuser/editprofil', $datauser);

						// $back['news']=$this->writermodel->readpemesanan($this->session->userdata('UID'));
						// $datauser['user']=$this->session->userData();
						// $this->load->view('headerpen', $datauser);
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
			
						$this->session->set_flashdata('msg', $pesan);
						
						$datauser['user']=$this->session->set_flashdata('msg', $pesan);
						$datauser['user']=$this->writermodel->readuser_index($indexdata);
						$this->load->view('aceuser/editprofil', $datauser);

					}
				}
			}
			else
			{
				$this->session->set_flashdata('msg', 'You Must SIGN IN To Access The Writer Page!!');
				redirect('controllerlogin/index');
			}
		}
    }
    ?>