<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dbquery extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function readcategory()
	{
		$query=$this->db->query("select * from kategoriberita WHERE namakategori != 'Other' ORDER BY namakategori");
		return $query->result_array();
	}

	public function readnews()
	{
		$query=$this->db->query("select * from berita WHERE status = 'publish' ORDER BY idberita DESC");
		return $query->result_array();
	}

	public function readnewsother($id)
	{
		$sql="SELECT * FROM berita b INNER JOIN user u ON b.UID = u.UID WHERE idberita != ? AND status = 'publish' ORDER BY idberita DESC LIMIT 3";
		$query=$this->db->query($sql, $id);
		return $query->result_array();
	}

	public function readnewscategory($index)
	{
		$sql='SELECT * FROM berita WHERE idkategori = ? AND status = "publish" ORDER BY idberita DESC';
		$query=$this->db->query($sql, $index);
		return $query->result_array();
	}

	public function readnewsdetail($id)
	{
		$sql='SELECT * FROM berita b INNER JOIN user u ON b.UID = u.UID WHERE idberita = ?';
		$query=$this->db->query($sql, $id);
		return $query->row();
	}

	// public function getlast()
	// {
	// 	$last=$this->db->query("select id_barang from barang ORDER BY id_barang DESC LIMIT 1");
	// 	return $last->row();
	// }

	// public function barangbaru($raw)
	// {
	// 	$sql="INSERT IGNORE INTO barang (nama_barang, harga_barang, stok_barang) VALUES(?,?,?);";
	// 	$this->db->query($sql, array($raw['namabarangtomodel'],$raw['hargatomodel'],$raw['stoktomodel']));
	// 	return $this->db->affected_rows();
	// }

	// public function readdata_index($index)
	// {
	// 	$sql='SELECT * FROM barang WHERE id_barang = ? LIMIT 1';
	// 	$query=$this->db->query($sql, $index);
	// 	return $query->row();
	// }

	// public function delete($raw)
	// {
	// 	$sql="DELETE FROM barang WHERE id_barang = ?;";
	// 	$this->db->query($sql, $raw['index']);
	// 	return $this->db->affected_rows();
	// }

	// public function edit($raw)
	// {
	// 	$sql="UPDATE barang SET nama_barang = ?, harga_barang = ?, stok_barang = ? WHERE id_barang = ?;";
	// 	$this->db->query($sql, array($raw['namabaranged'],$raw['hargaed'],$raw['stoked'],$raw['index']));
	// 	return $this->db->affected_rows();
	// }
}

?>