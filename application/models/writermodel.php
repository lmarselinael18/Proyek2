<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Writermodel extends CI_Model { 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function readdivisi()
	{
		$query=$this->db->query("select * from divisi");
		return $query->result_array();
	}


	public function readdivisi_index($index)
	{
		$sql='SELECT * FROM divisi WHERE id_divisi = ?';
		$query=$this->db->query($sql, $id_divisi);
		return $query->result_array();
	}

	public function readkelurahan($id_kecamatan)
	{
		$sql='SELECT * FROM kelurahan WHERE id_kecamatan = ?';
		$query=$this->db->query($sql, $id_kecamatan);
		return $query->result_array();
	}

	public function readpemesanan($UID)
	{
		$sql='SELECT dpkl.*, d.nama_divisi, d.kuota, u.nama_user FROM data_pkl AS dpkl, divisi AS d, user_pkl AS u WHERE dpkl.UID = ? AND dpkl.id_divisi = d.id_divisi AND dpkl.UID = u.UID';
		$query=$this->db->query($sql, $UID);
		return $query->result_array();
	}

	public function readpemesananhomepage()
	{
		$sql='SELECT dpkl.*, d.nama_divisi, d.kuota, u.nama_user FROM data_pkl AS dpkl, divisi AS d, user_pkl AS u ';
		$query=$this->db->query($sql);
		return $query->result_array();
	}

	public function readlaporan($UID)
	{
		$sql='SELECT * FROM user_pkl WHERE UID = ?';
		$query=$this->db->query($sql, $UID);
		return $query->result_array();
	}

	public function readcategory()
	{
		$query=$this->db->query("select * from bidang WHERE nama_bidang != 'Other'");
		return $query->result_array();
	}

	public function pemesanan($raw)
	{

		$this->db->insert('data_pkl', $raw);
		// $sql="INSERT IGNORE INTO data_pkl (id_divisi ,UID , jml_pkl, srt_pengantar, tgl_mulai, tgl_selesai, status) VALUES($sql, $raw['id_divisi_in'], $raw['UID_in'],$raw['jml_pkl_in'],$raw['srt_pengantar_in'],$raw['tgl_mulai_in'],$raw['tgl_selesai_in'],$raw['status_in']);";
		// $this->db->query($sql);


		return $this->db->affected_rows();
	}

		
	public function pemesanan2($raw)
		{
			$sql="INSERT IGNORE INTO data_pkl (id_divisi, UID, jml_pkl, srt_pengantar, tgl_mulai, tgl_selesai,status) VALUES(?,?,?,?,?,?,?);";
			$this->db->query($sql, array($raw['id_divisi'],$raw['UID'],$raw['jml_pkl'],$raw['srt_pengantar'],$raw['tgl_mulai'],$raw['tgl_selesai'],$raw['status']));
			return $this->db->affected_rows();
		}


	public function readdata_index($index)
	{
		$sql='SELECT * FROM data_pkl WHERE id_pkl = ?';
		$query=$this->db->query($sql, $index);
		return $query->result_array();
	}

	public function readdatalaporan_index($index)
	{
		$sql='SELECT * FROM user_pkl WHERE UID = ? LIMIT 1';
		$query=$this->db->query($sql, $index);
		return $query->result_array();
	}

	public function editnews($raw)
	{
		$sql="UPDATE data_pkl SET UID = ?,id_divisi = ?, jml_pkl = ?, tgl_mulai = ?,tgl_selesai=?,srt_pengantar=? WHERE id_pkl = ?;";
		$this->db->query($sql, array($raw['UID'],$raw['id_divisi'],$raw['jml_pkl'],$raw['tgl_mulai'],$raw['tgl_selesai'],$raw['srt_pengantar'],$raw['index']));
		return $this->db->affected_rows();
	}

	public function editnewsnosrt($raw)
	{
		$sql="UPDATE data_pkl SET UID = ?,id_divisi = ?, jml_pkl = ?, tgl_mulai = ?,tgl_selesai=? WHERE id_pkl = ?;";
		$this->db->query($sql, array($raw['UID'],$raw['id_divisi'],$raw['jml_pkl'],$raw['tgl_mulai'],$raw['tgl_selesai'],$raw['index']));
		return $this->db->affected_rows();
	}

	// public function editnewsnopicture($raw)
	// {
	// 	$sql="UPDATE perusahaan SET nama_perusahaan = ?, pimpinan = ?, alamat = ?,kelurahan=?,kecamatan=?, email = ?, no_telepon = ?, hrd = ?,karyawan_laki=?,karyawan_perempuan=?, jumlah_karyawan = ?, id_bidang = ? WHERE id_perusahaan = ?;";
	// 	$this->db->query($sql, array($raw['nama_perusahaan_up'],$raw['pimpinan_up'],$raw['alamat_up'],$raw['kelurahan_up'],$raw['kecamatan_up'],$raw['email_up'],$raw['no_telepon_up'],$raw['hrd_up'],$raw['karyawan_laki_up'],$raw['karyawan_perempuan_up'],$raw['jumlah_karyawan_up'],$raw['id_bidang_up'],$raw['index']));
	// 	return $this->db->affected_rows();
	// }	

	public function editlevel($raw)
	{
		$sql="UPDATE user_pkl SET level = ? WHERE UID = ?;";
		$this->db->query($sql, array($raw['level'],$raw['index']));
		return $this->db->affected_rows();
	}

	public function edituser($raw)
	{
		$sql="UPDATE user_pkl SET username = ?, password = ?, nama_user = ?, jurusan = ?,asal = ?, no_telpon = ?, email = ?, photo = ? WHERE UID = ?;";
		$this->db->query($sql, array($raw['username_up'],$raw['password_up'],$raw['nama_user_up'],$raw['jurusan_up'],$raw['asal_up'],$raw['no_telpon_up'],$raw['email_up'],$raw['photo_up'] ,$raw['index']));
		return $this->db->affected_rows();
	}

	public function editusernophotos($raw)
	{
		$sql="UPDATE user_pkl SET username = ?, password = ?, nama_user = ?, jurusan = ?, asal = ?, no_telpon = ?, email = ? WHERE UID = ?;";
		$this->db->query($sql, array($raw['username_up'],$raw['password_up'],$raw['nama_user_up'],$raw['jurusan_up'],$raw['asal_up'],$raw['no_telpon_up'],$raw['email_up'],$raw['index']));
		return $this->db->affected_rows();
	}

	public function uploadlaporan($raw)
	{
		$sql="UPDATE user_pkl SET nama_user = ?, laporan = ? WHERE UID = ?;";
		$this->db->query($sql, array($raw['nama_user_up'],$raw['laporan_up'],$raw['indexdata']));
		return $this->db->affected_rows();
	}

	public function readuser_index($index)
	{
		$sql='SELECT * FROM user_pkl WHERE UID = ? LIMIT 1';
		$query=$this->db->query($sql, $index);
		return $query->row();
	}

	public function readuser()
		{
			$query=$this->db->query("select * from user_pkl ");
			return $query->result_array();
		}

	public function deletepemesanan($raw)
		{
			$sql="DELETE FROM data_pkl WHERE id_pkl = ?;";
			$this->db->query($sql, $raw['index']);
			return $this->db->affected_rows();
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

/* End of file writermodel.php */
/* Location: ./application/models/writermodel.php */
?>