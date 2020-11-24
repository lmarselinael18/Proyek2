<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class writer3 extends CI_Controller {

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
				$this->load->view('aceuser-pending/headerpen', $datauser); 
				$this->load->view('aceuser-pending/datapemesanan', $datanews);
			}
			else
			{
				$this->session->set_flashdata('msg', 'You Must SIGN IN To Access The Writer Page!!');
				redirect('controllerlogin/index');
			}
		}

		public function hitung_sisa($id_divisi, $tgl_mulai, $tgl_selesai) {
			$semua_data = $this->db->query("SELECT * FROM data_pkl WHERE id_divisi = $id_divisi AND status IN ('Peserta', 'Pendaftar')")->result();
			$data_divisi = $this->db->get_where('divisi', array('id_divisi' => $id_divisi))->row();

			$jumlah_pkl = 0;

			foreach($semua_data as $data) {
				$period = new DatePeriod(
					new DateTime($data->tgl_mulai),
					new DateInterval('P1D'),
					new DateTime(date('Y-m-d', strtotime($data->tgl_selesai . ' +1 day')))
				);

				$arr_date = array();

				foreach ($period as $key => $value) {
					$arr_date[] = $value->format('Y-m-d');       
				}

				if(in_array($tgl_mulai, $arr_date)) {
					$jumlah_pkl += $data->jml_pkl;
				} else {
					if(in_array($tgl_selesai, $arr_date)) {
						$jumlah_pkl += $data->jml_pkl;
					}
				}
			}

			$sisa_pkl = $data_divisi->kuota - $jumlah_pkl;

			echo $sisa_pkl;
		}

		public function editnews($indexdata)
		{
			if ($this->session->userdata('logged_in'))
			{

						$config['upload_path'] = './images/news/';
						$config['allowed_types'] = 'doc|docx|pdf';
		   				$config['max_size']  = '2048';
		    			$config['remove_space'] = TRUE; 

		    			$this->load->library('upload', $config);
		    			if (!$this->upload->do_upload('srt_pengantar')) //jika gagal upload
		    			{
		    				$senddata['id_divisi']=$this->input->post('id_divisi');
							$senddata['UID']=$this->session->userdata('UID');
							$senddata['jml_pkl']=$this->input->post('jml_pkl');
							$senddata['tgl_mulai']=$this->input->post('tgl_mulai');
							$senddata['tgl_selesai']=$this->input->post('tgl_selesai');
							$senddata['index']=$indexdata;
							//$senddata['status']="pendaftar";
			
							$back['jumlah']=$this->writermodel->editnewsnosrt($senddata);
							$back['array']=$this->writermodel->readpemesanan($this->session->userdata('UID'));
							$this->load->view('aceuser-pending/datapemesanan',$back);

							$pesan = "Pemesanan berhasil diperbarui";
			
							$this->session->set_flashdata('msg', $pesan);
							redirect('writer3/index');
		    			}
		    			else
		    			{
		    			$file =array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');

		    				$senddata['srt_pengantar']=$file['file']['file_name'];
		    				$senddata['id_divisi']=$this->input->post('id_divisi');
							$senddata['UID']=$this->session->userdata('UID');
							$senddata['jml_pkl']=$this->input->post('jml_pkl');
							$senddata['tgl_mulai']=$this->input->post('tgl_mulai');
							$senddata['tgl_selesai']=$this->input->post('tgl_selesai');
							$senddata['index']=$indexdata;
							//$senddata['status']="pendaftar";
			
							$back['jumlah']=$this->writermodel->editnews($senddata);
							$back['array']=$this->writermodel->readpemesanan($this->session->userdata('UID'));
							$this->load->view('aceuser-pending/datapemesanan',$back);

							$pesan = "Pemesanan berhasil diperbarui";
			
							$this->session->set_flashdata('msg', $pesan);
							redirect('writer3/index');
						}
			}
			else
			{
				$this->session->set_flashdata('msg', 'You Must SIGN IN To Access The Admin Page!!');
				redirect('controllerlogin/index');
			}
		}

		public function deletepemesanan($indexdata)
		{
			if ($this->session->userdata('logged_in'))
			{
					$baru['level']='calon';
					$baru['index']=$this->session->userdata('UID');
					$krm['index']=$indexdata;
											
					$kembali2['jumlah']=$this->writermodel->deletepemesanan($krm);
					$kembali['jumlah']=$this->writermodel->editlevel($baru);
	
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

					$pesan = "Pembatalan Successful Removed";
					$this->session->set_flashdata('msg1', $pesan);
					redirect('writer3/index');
					
			}
			else
			{
				$this->session->set_flashdata('msg', 'You Must SIGN IN To Access The Admin Page!!');
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
					$this->load->view('aceuser-pending/editprofil', $datauser);
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
						$this->load->view('aceuser-pending/editprofil', $datauser);
						
						
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
						$this->load->view('aceuser-pending/editprofil', $datauser);

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