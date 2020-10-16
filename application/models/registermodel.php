<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Registermodel extends CI_Model {

		public function adduser($raw)
		{
			$sql="INSERT IGNORE INTO user_pkl (username, password, nama_user, jurusan, asal, no_telpon, email, laporan,level) VALUES(?,?,?,?,?,?,?,?,?);";
			$this->db->query($sql, array($raw['usernamenew'],$raw['passwordnew'],$raw['namausernew'],$raw['jurusannew'],$raw['asalnew'],$raw['notelponnew'],$raw['emailnew'],$raw['laporannew'],$raw['levelnew']));
			return $this->db->affected_rows();
		}

		public function adduserwithphoto($raw)
		{
			$sql="INSERT IGNORE INTO user_pkl (username, password, nama_user, jurusan, asal, no_telpon, email, photo, laporan,level) VALUES(?,?,?,?,?,?,?,?,?,?);";
			$this->db->query($sql, array($raw['usernamenew'],$raw['passwordnew'],$raw['namausernew'],$raw['jurusannew'],$raw['asalnew'],$raw['notelponnew'],$raw['emailnew'],$raw['photonew'],$raw['laporannew'],$raw['levelnew']));
			return $this->db->affected_rows();
		}

	} 
	
	/* End of file adminmodel.php */
	/* Location: ./application/models/adminmodel.php */
?>