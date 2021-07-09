<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class SuratkeluarModel extends CI_Model {
	public $table = 'surat_keluar';

	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function update($data, $id)
	{
		return $this->db->update($this->table, $data, array('id' => $id));
	}

	public function delete($id)
	{
		return $this->db->delete($this->table, array('id' => $id));
	}
	public function get_all(){
		$this->db->select('s.id,s.id_penomoran,s.nama_dikirim,s.jenis_kegiatan,s.link,s.tanggal,p.penomoran');
		$this->db->from('surat_keluar s');
		$this->db->join('penomoran p','p.id=s.id_penomoran');
		return $this->db->get();
	}
	public function get_by_id($id)
	{
		$query = $this->db->get_where($this->table, array('id' => $id));
		$data['object'] = $query->row();
		$data['array'] = $query->row_array();
		$data['count'] = $query->num_rows();
		return $data;
	}
	//Mendapatkan penomeran dari db untuk dropdown
	public function get_penomoran(){
		$this->db->select('*');
		$this->db->from('penomoran');
		return $this->db->get()->result();
	}
}
?>