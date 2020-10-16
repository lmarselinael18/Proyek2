<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class homepage extends CI_Controller {
	
		public function __construct()
		{
			parent::__construct();
			$this->load->helper('url','form'); 
			// $this->load->database();
			$this->load->model('writermodel');
			// $this->load->library('form_validation');
			// $this->load->library('session');
		}
	
		public function index()
		{
			$datanews['news']=$this->writermodel->readpemesananhomepage();
			$datanews['user']=$this->session->userData();
			$datanews['divisi']=$this->writermodel->readdivisi();
			$this->load->view('homepage/index', $datanews);
			
		}

		public function loadprofil()
		{
			$this->load->view('homepage/profil');
		}

		public function loadcarapemesanan()
		{
			$this->load->view('homepage/carapemesanan');
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
		
	}
	
	/* End of file admin.php */
	/* Location: ./application/controllers/admin.php */
?>