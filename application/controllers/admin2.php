<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class admin2 extends CI_Controller {
	
		public function __construct()
		{
			parent::__construct();
			$this->load->helper('url','form');
			$this->load->database();
			$this->load->model('adminmodel');
			$this->load->library('form_validation');
			$this->load->library('session');
		} 
	
		public function index()
		{
			if ($this->session->userdata('logged_in'))
			{
				if ($this->session->userdata('level') == 'superuser')
				{
					$datauser['user']=$this->adminmodel->readadmin();
					$datadivisi['news']=$this->adminmodel->readdivisi();
					$this->load->view('aceadmin/headersuper', $datauser); 
					$this->load->view('aceadmin/indexsuper', $datadivisi);
				}
				else
				{
					$this->session->set_flashdata('msg', 'You Cannot Access The Admin Page!!');
					redirect('controllerlogin/index');
				}
			} 
			else
			{
				$this->session->set_flashdata('msg', 'You Must SIGN IN To Access The Admin Page!!');
				redirect('controllerlogin/index');
			}
		}

		public function divisi()
		{
			if ($this->session->userdata('logged_in'))
			{
				if ($this->session->userdata('level') == 'superuser') 
				{
					$datauser['divisi']=$this->adminmodel->readdivisi();
					$this->load->view('aceadmin/datadivisisuper', $datauser);
				}
				else
				{
					$this->session->set_flashdata('msg', 'You Cannot Access The Admin Page!!');
					redirect('controllerlogin/index');
				}
			}
			else
			{
				$this->session->set_flashdata('msg', 'You Must SIGN IN To Access The Admin Page!!');
				redirect('controllerlogin/index');
			}
		}

		public function editdinas($indexdata) 
		{
			if ($this->session->userdata('logged_in'))
			{ 
				if ($this->session->userdata('level') == 'superuser')
				{
						$krm['nama_divisi']=$this->input->post('up_nama_divisi');
						$krm['kuota']=$this->input->post('up_kuota');
						$krm['id_divisi']=$indexdata; 
					
						$kembali['jumlah']=$this->adminmodel->updatedinas($krm);

						$pesan = "Update Data Dinas Sukses";

						$datauser['notif']=$this->session->set_flashdata('msg', $pesan);
						$datauser['divisi']=$this->adminmodel->readdivisi();

						$this->load->view('aceadmin/datadivisisuper', $datauser);

						//redirect('admin2/divisi');
					
				}
				else
				{
					$this->session->set_flashdata('msg', 'You Cannot Access The Admin Page!!');
					redirect('controllerlogin/index');
				}
			}
			else
			{
				$this->session->set_flashdata('msg', 'You Must SIGN IN To Access The Admin Page!!');
				redirect('controllerlogin/index');
			}
		}

		public function newadmin()
		{
			if ($this->session->userdata('logged_in'))
			{

				if ($this->session->userdata('level') == 'superuser')
				{
					$this->form_validation->set_rules('username', 'Username', 'trim|required');
					$this->form_validation->set_rules('password', 'password', 'trim|required');
					$this->form_validation->set_rules('id_divisi', 'id_divisi', 'trim|required');
				
				if($this->form_validation->run() == FALSE)	{
					$datanews['news']=$this->adminmodel->readdivisi();
					$this->load->view('aceadmin/adduseradmin',$datanews);				
				}
				else {
	    					$senddata['usernamenew']=$this->input->post('username');
							$senddata['passwordnew']=$this->input->post('password');
							$senddata['id_divisinew']=$this->input->post('id_divisi');
							$senddata['namaadminnew']=$this->input->post('nama_admin');
							$senddata['levelnew']='admin';
	
							$back['jumlah']=$this->adminmodel->adduser($senddata);
	
							$pesan = "Admin Baru Telah ditambahkan";
		
							$this->session->set_flashdata('msg', $pesan);
							redirect('admin2/index');
	    			}		
	    		}
				else
				{
					$this->session->set_flashdata('msg', 'You Cannot Access The Admin Page!!');
					redirect('admin2/index');
				}
			}
			else
			{
				$this->session->set_flashdata('msg', 'You Must SIGN IN To Access The Admin Page!!');
				redirect('controllerlogin/index');
			}
		}

		public function newdinas()
		{
			if ($this->session->userdata('logged_in'))
			{

				if ($this->session->userdata('level') == 'superuser')
				{
					$this->form_validation->set_rules('nama_divisi', 'nama_divisi', 'trim|required');
					$this->form_validation->set_rules('kuota', 'kuota', 'trim|required');
				
				if($this->form_validation->run() == FALSE)	{
					$datanews['news']=$this->adminmodel->readdivisi();
					$this->load->view('aceadmin/adddinas',$datanews);				
				}
				else 
				{
	    					$senddata['nama_divisi']=$this->input->post('nama_divisi');
							$senddata['kuota']=$this->input->post('kuota');
	
							$back['jumlah']=$this->adminmodel->adddinas($senddata);
	
							$pesan = "Dinas Baru Telah ditambahkan";
		
							$datauser['notif']=$this->session->set_flashdata('msg', $pesan);
							$datauser['divisi']=$this->adminmodel->readdivisi();
							$this->load->view('aceadmin/datadivisisuper', $datauser);

							//redirect('admin2/divisi');
	    			}		
	    		}
				else
				{
					$this->session->set_flashdata('msg', 'You Cannot Access The Admin Page!!');
					redirect('controllerlogin/index');
				}
			}
			else
			{
				$this->session->set_flashdata('msg', 'You Must SIGN IN To Access The Admin Page!!');
				redirect('controllerlogin/index');
			}
		}

		public function editadmin($indexdata)
		{
			if ($this->session->userdata('logged_in'))
			{
									
						$krm['username_up']=$this->input->post('up_username');
						$krm['password_up']=$this->input->post('up_password');
						$krm['id_divisi_up']=$this->input->post('up_id_divisi');
						$krm['nama_admin_up']=$this->input->post('up_nama_admin');
								
						$krm['index']=$indexdata;
										
						$kembali['jumlah']=$this->adminmodel->editusertabel($krm);

						
						$pesan = "Data telah diperbarui";
						$this->session->set_flashdata('msg', $pesan);

							$datauser['user']=$this->adminmodel->readadmin();
							$datadivisi['news']=$this->adminmodel->readdivisi();
							$this->load->view('aceadmin/headersuper', $datauser);
							$this->load->view('aceadmin/indexsuper', $datadivisi);

			}
			else
			{
				$this->session->set_flashdata('msg', 'You Must SIGN IN To Access The Writer Page!!');
				redirect('admin2/index');
			}
		}

		function deleteAd($id){
			if ($this->session->userdata('logged_in'))
			{
				if ($this->session->userdata('level') == 'superuser')
				{
				$this->db->where('UAID',$id);
				$this->db->delete('user_admin');

				//redirect('admin2/index');
				
				$pesan = "Data Berhasil di Hapus";
		
				$datadivisi['notif']=$this->session->set_flashdata('msg', $pesan);
				$datauser['user']=$this->adminmodel->readadmin();
				$datadivisi['news']=$this->adminmodel->readdivisi();
				$this->load->view('aceadmin/headersuper', $datauser); 
				$this->load->view('aceadmin/indexsuper', $datadivisi);

				}
				else
				{
					$this->session->set_flashdata('msg', 'You Cannot Access The Admin Page!!');
					redirect('controllerlogin/index');
				}
			}
			else
			{
				$this->session->set_flashdata('msg', 'You Must SIGN IN To Access The Admin Page!!');
				redirect('controllerlogin/index');
			}
		}

		function deleteDinas($id){
			if ($this->session->userdata('logged_in'))
			{
				if ($this->session->userdata('level') == 'superuser')
				{
				$this->db->where('id_divisi',$id);
				$this->db->delete('divisi');

				//redirect('admin2/index');
				
				$pesan = "Data Dinas Berhasil di Hapus";
		
				$datauser['notif']=$this->session->set_flashdata('msg', $pesan);
				$datauser['divisi']=$this->adminmodel->readdivisi();
				$this->load->view('aceadmin/datadivisisuper', $datauser);

				}

				else
				{
					$this->session->set_flashdata('msg', 'You Cannot Access The Admin Page!!');
					redirect('controllerlogin/index');
				}
			}
			else
			{
				$this->session->set_flashdata('msg', 'You Must SIGN IN To Access The Admin Page!!');
				redirect('controllerlogin/index');
			}
		}
}