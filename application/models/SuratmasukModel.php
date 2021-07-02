<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class SuratmasukModel extends CI_Model {
	public $table = 'surat_masuk';

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
		$this->db->select('*');
		$this->db->from('surat_masuk');
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
}
?>