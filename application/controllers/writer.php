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
		public function get_divisi(){
			$id_divisi=$this->input->post('id_divisi');
			$data=$this->writermodel->readdivisi_index($id_divisi);
			echo json_encode($data);
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
		public function hitung_sisa2($id_divisi, $tgl_mulai, $tgl_selesai, $jumlah_pkl){
			$bln1= date('m',strtotime($tgl_mulai));
			$bln2 = date('m',strtotime($tgl_selesai));
			$year = date('Y',strtotime($tgl_selesai));
			$tgl1 = "2019-".$bln1."-01";
			$tgl2 = $year."-".$bln2."-02";
			$status="sukses";
			$data = array();
				$period = new DatePeriod(
					new DateTime($tgl1),
					new DateInterval('P1M'),
					new DateTime($tgl2)
				);

				$arr_date = array();

				foreach ($period as $key => $value) {
					$hasil = 0;
					$bulan = $value->format('m'); 
					$bulannama="";
				if($bulan == '01'){
					$bulannama="Januari";
				} else if ($bulan == '02') {
					$bulannama="Februari";
				}else if ($bulan == '03') {
					$bulannama="Maret";
				}else if ($bulan == '04') {
					$bulannama="April";
				}else if ($bulan == '05') {
					$bulannama="Mei";
				}else if ($bulan == '06') {
					$bulannama="Juni";
				}else if ($bulan == '07') {
					$bulannama="Juli";
				}else if ($bulan == '08') {
					$bulannama="Agustus";
				}else if ($bulan == '09') {
					$bulannama="September";
				}else if ($bulan == '10') {
					$bulannama="Oktober";
				}else if ($bulan == '11') {
					$bulannama="November";
				}else if ($bulan == '12') {
					$bulannama="Desember";
				}
				$kolom = "K".$bulan;
				$max = $this->db->query("select $kolom from divisi where id_divisi = $id_divisi ")->row();
				$jmlpeserta = $this->db->query("select id_divisi,sum(jml_pkl) as hasil from data_pkl where DATE_FORMAT(tgl_mulai, '%m')=$bulan or DATE_FORMAT(tgl_selesai, '%m') = $bulan and  status = 'Pendaftar' group by id_divisi")->row();
				if(isset($jmlpeserta->id_divisi)){
					if($id_divisi == $jmlpeserta->id_divisi){
						$hasil = $jmlpeserta->hasil;
					}else{
						$hasil = 0;
					}
				}else{
					$hasil = 0;
				}

				if($jumlah_pkl>$max->$kolom){
					$data[] = array("bulannama"=>$bulannama,"value"=>"Kuota Penuh","pendaftar"=>$hasil);
					$status = "error";
					}
				}
				
			if($status=="sukses"){
				foreach ($period as $key => $value) {
				$bulan = $value->format('m');

				$bulannama="";
				if($bulan == '01'){
					$bulannama="Januari";
				} else if ($bulan == '02') {
					$bulannama="Februari";
				}else if ($bulan == '03') {
					$bulannama="Maret";
				}else if ($bulan == '04') {
					$bulannama="April";
				}else if ($bulan == '05') {
					$bulannama="Mei";
				}else if ($bulan == '06') {
					$bulannama="Juni";
				}else if ($bulan == '07') {
					$bulannama="Juli";
				}else if ($bulan == '08') {
					$bulannama="Agustus";
				}else if ($bulan == '09') {
					$bulannama="September";
				}else if ($bulan == '10') {
					$bulannama="Oktober";
				}else if ($bulan == '11') {
					$bulannama="November";
				}else if ($bulan == '12') {
					$bulannama="Desember";
				}

				$kolom = "K".$bulan;
				$hasil = 0;
				$max = $this->db->query("select $kolom from divisi where id_divisi = $id_divisi ")->row();
				$jmlpeserta = $this->db->query("select id_divisi,sum(jml_pkl) as hasil from data_pkl where DATE_FORMAT(tgl_mulai, '%m')=$bulan or DATE_FORMAT(tgl_selesai, '%m') = $bulan and  status = 'Pendaftar' group by id_divisi")->row();
				if(isset($jmlpeserta->id_divisi)){
					if($id_divisi == $jmlpeserta->id_divisi){
						$hasil = $jmlpeserta->hasil;
					}else{
						$hasil = 0;
					}
				}else{
					$hasil = 0;
				}
				
				// $jmlpeserta = $this->db->query("select Month(tgl_mulai) as hasil from data_pkl where id_divisi = $id_divisi group by id_pkl")->row();
				$data[] = array("bulannama"=>$bulannama,
								"value"=>$max->$kolom,
								"pendaftar"=>$hasil);
				}
			}

			echo json_encode($data);

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
							$this->load->view('aceuser/datapemesanan',$back);

							$pesan = "Pemesanan berhasil diperbarui";
			
							$this->session->set_flashdata('msg', $pesan);
							redirect('writer/index');
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
							$this->load->view('aceuser/datapemesanan',$back);

							$pesan = "Pemesanan berhasil diperbarui";
			
							$this->session->set_flashdata('msg', $pesan);
							redirect('writer/index');
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