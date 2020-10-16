<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Adminmodel extends CI_Model {

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
		$query=$this->db->query($sql, $index);
		return $query->result_array();
	}
 

	public function readuser($id_divisi)
	{
		$sql='SELECT dpkl.*, d.nama_divisi, d.kuota, u.laporan, u.nama_user FROM data_pkl AS dpkl, divisi AS d, user_pkl AS u WHERE dpkl.id_divisi = ? AND dpkl.id_divisi = d.id_divisi AND dpkl.UID = u.UID';
		$query=$this->db->query($sql, $id_divisi);
		return $query->result_array();
	}

	public function readadmin() 
	{
		$query=$this->db->query("select ua.*,d.id_divisi,d.nama_divisi from user_admin as ua,divisi as d WHERE ua.level='admin' AND d.id_divisi=ua.id_divisi");
		return $query->result_array();
	}

	public function readsuperuser($index) 
	{
		$sql='SELECT * FROM user_admin WHERE UAID = ?';
		$query=$this->db->query($sql, $index);
		return $query->result_array();
	}

	public function readaktiv()
	{
		$query=$this->db->query("select * from user_pkl WHERE level ='peserta'");
		return $query->result_array();
	}

	public function readuserPKL()
	{
		$query=$this->db->query("select * from user_pkl ");
		return $query->result_array();
	}

	public function readuser_index($index)
	{
		$sql='SELECT * FROM user_admin WHERE UAID = ? LIMIT 1';
		$query=$this->db->query($sql, $index);
		return $query->row();
	}

	public function readadmin_index($index)
	{
		$sql='SELECT * FROM user_admin WHERE UAID = ? LIMIT 1';
		$query=$this->db->query($sql, $index);
		return $query->row();
	}

	public function readdata_index($index)
	{
		$sql='SELECT * FROM data_pkl WHERE id_pkl = ? LIMIT 1';
		$query=$this->db->query($sql, $index);
		return $query->row();
	}

	public function updatekuota($raw)
	{
		$sql="UPDATE divisi SET kuota = ? WHERE id_divisi = ?;";
		$this->db->query($sql, array($raw['kuota'],$raw['id_divisi']));
		return $this->db->affected_rows();
	}
	// public function upkuotaPerbulan($raw)
	// {
	// 	$sql="UPDATE divisi SET kuota = ?,01 = ?,02 = ?,03 = ?,04 = ?,05 = ?,06 = ?,07 = ?,08 = ?,09 = ?,10 = ?,11 = ?,12 = ? WHERE id_divisi = ?;";
	// 	$this->db->query($sql, array($raw['kuota'],$raw['01'],$raw['02'],$raw['03'],$raw['04'],$raw['05'],$raw['06'],$raw['07'],$raw['08'],$raw['09'],$raw['10'],$raw['11'],$raw['12'],$raw['id_divisi']));
	// 	return $this->db->affected_rows();
	// }

	public function upkuotaPerbulan($raw)
	{
		$data=array('kuota'=>$raw['kuota'],'K01'=>$raw['01'],'K02'=>$raw['02'],'K03'=>$raw['03'],'K04'=>$raw['04'],'K05'=>$raw['05'],'K06'=>$raw['06'],'K07'=>$raw['07'],'K08'=>$raw['08'],'K09'=>$raw['09'],'K10'=>$raw['10'],'K11'=>$raw['11'],'K12'=>$raw['12']);
		$this->db->WHERE('id_divisi',$raw['id_divisi']);
		$this->db->UPDATE('divisi',$data);
	}


	public function updatedinas($raw)
	{
		$sql="UPDATE divisi SET nama_divisi=?, kuota = ? WHERE id_divisi = ?;";
		$this->db->query($sql, array($raw['nama_divisi'],$raw['kuota'],$raw['id_divisi']));
		return $this->db->affected_rows();
	}

		public function readnews()
		{
			$sql='SELECT * FROM user_admin';
			$query=$this->db->query($sql);
			return $query->result_array();
		}


		public function adduser($raw)
		{
			$sql="INSERT IGNORE INTO user_admin (username, password, id_divisi, nama_admin, level) VALUES(?,?,?,?,?);";
			$this->db->query($sql, array($raw['usernamenew'],$raw['passwordnew'],$raw['id_divisinew'],$raw['namaadminnew'],$raw['levelnew']));
			return $this->db->affected_rows();
		}

		public function adddinas($raw)
		{
			$sql="INSERT IGNORE INTO divisi (nama_divisi, kuota) VALUES(?,?);";
			$this->db->query($sql, array($raw['nama_divisi'],$raw['kuota']));
			return $this->db->affected_rows();
		}

		public function edituser($raw)
	{
		$sql="UPDATE user_admin SET username = ?, password = ?, nama_admin = ? WHERE UAID = ?;";
		$this->db->query($sql, array($raw['username_up'],$raw['password_up'],$raw['nama_admin_up'],$raw['index']));
		return $this->db->affected_rows();
	}

		public function editusertabel($raw)
	{
		$sql="UPDATE user_admin SET username = ?, password = ?, id_divisi = ?, nama_admin = ? WHERE UAID = ?;";
		$this->db->query($sql, array($raw['username_up'],$raw['password_up'],$raw['id_divisi_up'],$raw['nama_admin_up'],$raw['index']));
		return $this->db->affected_rows();
	}

	public function editsuperuser($raw)
	{
		$sql="UPDATE user_admin SET username = ?, password = ?, nama_admin = ?, level = ? WHERE UAID = ?;";
		$this->db->query($sql, array($raw['username_up'],$raw['password_up'],$raw['nama_admin_up'],$raw['level_up'],$raw['index']));
		return $this->db->affected_rows();
	}

		public function readnews_index($index)
		{
			$sql='SELECT * FROM user_admin  WHERE UAID = ? LIMIT 1';
			$query=$this->db->query($sql, $index);
			return $query->row();
		}

		public function editlevel($raw)
		{
		$sql="UPDATE user_pkl SET level = ? WHERE UID = ?;";
		$this->db->query($sql, array($raw['level'],$raw['index']));
		return $this->db->affected_rows();
		}

		public function raeddata_index($index)
		{
			$sql='SELECT * FROM user_pkl  WHERE UID = ? LIMIT 1';
			$query=$this->db->query($sql, $index);
			return $query->row();
		}

		public function editnews($raw)
		{
			$sql="UPDATE data_pkl SET status = ? WHERE id_pkl = ?;";
			$this->db->query($sql, array($raw['status_up'],$raw['index']));
			return $this->db->affected_rows();
		}


		public function deletenewsUID($raw)
		{
			$sql="DELETE FROM user_admin WHERE UAID = ?;";
			$this->db->query($sql, $raw['index']);
			return $this->db->affected_rows();
		}

		public function deleteuser($raw)
		{
			$sql="DELETE FROM user_admin WHERE UAID = ?;";
			$this->db->query($sql, $raw['index']);
			return $this->db->affected_rows();
		}

	}
	
	/* End of file adminmodel.php */
	/* Location: ./application/models/adminmodel.php */
?>