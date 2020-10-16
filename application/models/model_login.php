<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {

	//mengambil tabel users
    // public $table = 'user';

    public function cekAkun($username, $password)
    {
    	//cari username lalu lakukan validasi
    	$this->db->select('*');
        $this->db->from('user_pkl');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
    	$query = $this->db->get()->row();
    	$hash="";
    	if (!$query) //bernilai 1 jika user tidak ditemukan
    	{ 
            $this->db->select('*');
        $this->db->from('user_admin');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get()->row();
    	  if (!$query) {
              return 1;
          } else {
            $userData = array(
            'UAID' => $query->UAID,
            'username' => $query->username,
            'password' => $query->password,
            'id_divisi' => $query->id_divisi,
            'nama_admin' => $query->nama_admin,
            'level' => $query->level,
            'logged_in' => TRUE
            );
            $this->session->set_userdata($userData);
            return $query;
          }
    	}
        $hash = $query->password;
    	if($password != $hash) //bernilai 2 jika password salah
    	{ 
    	  return 2;
    	} 
    	else
    	{
            $userData = array(
            'username' => $query->username,
            'password' => $query->password,
            'nama_user' => $query->nama_user,
            'UID' => $query->UID,
            'jurusan' => $query->jurusan,
            'asal' => $query->asal,
            'no_telpon' => $query->no_telpon,
            'email' => $query->email,
            'photo' => $query->photo,
            'level' => $query->level,
            'logged_in' => TRUE
            );
            $this->session->set_userdata($userData);
    	  return $query;
    	} 
    }

    // public function cekakun($username, $password)
    // {
        
    //     $query=$this->db->get();
        
    //     if (!$query) //bernilai 1 jika user tidak ditemukan
    //     { 
    //       return 1;
    //     }
    //     else if($password != $hash) //bernilai 2 jika password salah
    //     { 
    //       return 2;
    //     } 
    //     else
    //     {
    //       return $query;
    //     } 
    // }
}

?>
