<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Admin extends CI_Controller {
	
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
				if ($this->session->userdata('level') == 'admin')
				{
					$datauser['session']=$this->session->userData();
					$datauser['user']=$this->adminmodel->readuser($this->session->userdata('id_divisi'));
					$datauser['userPKL']=$this->adminmodel->readuserPKL();
					$datauser['divisi']=$this->adminmodel->readdivisi_index($this->session->userdata('id_divisi'));
					
					$this->load->view('aceadmin/dashboardadmin', $datauser);
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

		public function PrintLaporan()
		{
		    $this->load->library('Mypdf');
		    $datauser['user']=$this->adminmodel->readuser($this->session->userdata('id_divisi'));
		    $this->mypdf->generate('aceadmin/laporan', $datauser, 'laporan-data PKL', 'A4', 'landscape');
		} 		

		public function pesan()
		{
			if ($this->session->userdata('logged_in'))
			{
				if ($this->session->userdata('level') == 'admin')
				{
					$datauser['user']=$this->adminmodel->readuser($this->session->userdata('id_divisi'));
					$this->load->view('aceadmin/datapesanpkl', $datauser);
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
				if ($this->session->userdata('level') == 'admin')
				{
					$datauser['divisi']=$this->adminmodel->readdivisi_index($this->session->userdata('id_divisi'));
					$this->load->view('aceadmin/datadivisi', $datauser);
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

		public function editdivisi($indexdata) 
		{
			if ($this->session->userdata('logged_in'))
			{
				if ($this->session->userdata('level') == 'admin')
				{
						$krm['kuota']=$this->input->post('up_kuota');
						$krm['01']=$this->input->post('01');
						$krm['02']=$this->input->post('02');
						$krm['03']=$this->input->post('03');
						$krm['04']=$this->input->post('04');
						$krm['05']=$this->input->post('05');
						$krm['06']=$this->input->post('06');
						$krm['07']=$this->input->post('07');
						$krm['08']=$this->input->post('08');
						$krm['09']=$this->input->post('09');
						$krm['10']=$this->input->post('10');
						$krm['11']=$this->input->post('11');
						$krm['12']=$this->input->post('12');
						$krm['id_divisi']=$indexdata; 
					
						//$kembali['jumlah']=$this->adminmodel->updatekuota($krm);

						$kembali['jumlah']=$this->adminmodel->upkuotaPerbulan($krm);

						$pesan = "Update Kuota Sukses";

						$datauser['notif']=$this->session->set_flashdata('msg', $pesan);
						$datauser['divisi']=$this->adminmodel->readdivisi_index($this->session->userdata('id_divisi'));
						$this->load->view('aceadmin/datadivisi', $datauser);

						//redirect('admin/divisi');
					
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


		public function aktiv()
		{
			if ($this->session->userdata('logged_in'))
			{
				if ($this->session->userdata('level') == 'admin')
				{
					$cur_divisi = $this->session->userdata('id_divisi');
					$semua_pkl = $this->db->get_where('data_pkl', array('id_divisi' => $cur_divisi, 'status' => 'Peserta'))->result();

					$arr_ketua = array();

					foreach($semua_pkl as $pkl) {
						$arr_ketua[] = $pkl->UID;
					}

					$ids = join("','", $arr_ketua);

					$datauser['user']=$this->db->query("SELECT * FROM user_pkl WHERE UID IN ('$ids')")->result_array();
					$this->load->view('aceadmin/aktivview', $datauser);
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

		public function ubahstatuspkl()
		{
			if ($this->session->userdata('logged_in'))
			{
				if ($this->session->userdata('level') == 'admin')
				{
					$datauser['user']=$this->adminmodel->readuser($this->session->userdata('id_divisi'));
					$this->load->view('aceadmin/datastatuspkl', $datauser);
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

		public function updatestatuspkl($indexdata,$tgl_mulai,$tgl_selesai,$jml_pkl,$id_divisi)
		{
			if ($this->session->userdata('logged_in'))
			{
				if ($this->session->userdata('level') == 'admin')
				{
						// $datauser['user']=$this->adminmodel->readuser($this->session->userdata('id_divisi'));
						// $this->load->view('aceadmin/datastatuspkl', $datauser);

						$krm['status_up']=$this->input->post('up_status');
						$krm['index']=$indexdata;

						
						$kembali['jumlah']=$this->adminmodel->editnews($krm);

						$level['level']=$this->input->post('up_status');
						$level['index']=$this->input->post('up_UID'); 

						$kirim['level1']=$this->adminmodel->editlevel($level);

						$pesan = "Status Peserta PKL berhasil diperbarui";

						$kembali['notif']=$this->session->set_flashdata('msg', $pesan);
						$kembali['news']=$this->adminmodel->readnews();
						$kembali['user']=$this->adminmodel->readuser($this->session->userdata('id_divisi'));

						if ($this->input->post('up_status')=='peserta') {
						$bln1= date('m',strtotime($tgl_mulai));
						$bln2 = date('m',strtotime($tgl_selesai));
						$tgl1 = "2019-".$bln1."-01";
						$tgl2 = "2019-".$bln2."-02";
							$period = new DatePeriod(
								new DateTime($tgl1),
								new DateInterval('P1M'),
								new DateTime($tgl2)
							);

						foreach ($period as $key => $value) {
						$bulan = $value->format('m'); 
						$kolom = "K".$bulan;
						$iddivisi= $id_divisi;
						$max = $this->db->query("select $kolom from divisi where id_divisi = $iddivisi")->row();
						$saatini = $max->$kolom;
						$sisa = $saatini - $jml_pkl;
						$this->db->query("update divisi set $kolom = $sisa where id_divisi = $iddivisi");
						}
					}	else if ($this->input->post('up_status')=='Selesai')	
					{
						$bln1= date('m',strtotime($tgl_mulai));
						$bln2 = date('m',strtotime($tgl_selesai));
						$tgl1 = "2019-".$bln1."-01";
						$tgl2 = "2019-".$bln2."-02";
							$period = new DatePeriod(
								new DateTime($tgl1),
								new DateInterval('P1M'),
								new DateTime($tgl2)
							);

						foreach ($period as $key => $value) {
						$bulan = $value->format('m'); 
						$kolom = "K".$bulan;
						$iddivisi= $id_divisi;
						$max = $this->db->query("select $kolom from divisi where id_divisi = $iddivisi")->row();
						$saatini = $max->$kolom;
						$sisa = $saatini + $jml_pkl;
						$this->db->query("update divisi set $kolom = $sisa where id_divisi = $iddivisi");
					}
				}

						$this->load->view('aceadmin/datastatuspkl', $kembali);						
						//redirect('admin/ubahstatuspkl');
					
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

		
		public function edituser($indexdata)
		{
			if ($this->session->userdata('logged_in'))
			{
				$this->form_validation->set_rules('up_username', 'Username', 'trim|required');
				$this->form_validation->set_rules('up_password', 'Password', 'trim|required');
				$this->form_validation->set_rules('up_nama_admin', 'Nama_admin', 'trim|required');
		
				if($this->form_validation->run()==FALSE)
				{
					$datauser['user']=$this->adminmodel->readadmin_index($indexdata);
					$this->load->view('aceadmin/editprofiladmindivisi', $datauser);
				}
				else 
				{
						
						$krm['username_up']=$this->input->post('up_username');
						$krm['password_up']=$this->input->post('up_password');
						$krm['nama_admin_up']=$this->input->post('up_nama_admin');
		
						$krm['index']=$indexdata;
										
						$kembali['jumlah']=$this->adminmodel->edituser($krm);

						$userr=$this->adminmodel->readadmin_index($indexdata);
				
						$userData = array(
	        			'username' => $userr->username,
	        			'password' => $userr->password,
	        			'nama_admin' => $userr->nama_admin,
	        			'logged_in' => TRUE
	      				);
	      				$this->session->set_userdata($userData);
						
						
						$pesan = "Data Admin telah diperbarui";
						
						$datauser['pesan']=$this->session->set_flashdata('msg', $pesan);
						$datauser['user']=$this->adminmodel->readadmin_index($indexdata);
						$this->load->view('aceadmin/editprofiladmindivisi', $datauser);
						//$this->load->view('aceadmin/dashboardadmin', $datauser);
			
				}
			}
			else
			{
				$this->session->set_flashdata('msg', 'You Must SIGN IN To Access The Writer Page!!');
				redirect('controllerlogin/index');
			}
		}

	}
	
	/* End of file admin.php */
	/* Location: ./application/controllers/admin.php */
?>