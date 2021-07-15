<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class KonstitusiModel extends CI_Model {
	public $table = 'konstitusi';

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
		$get_berkas = $this->db->get_where('konstitusi',['id' => $id])->row();
        if ($get_berkas){
           if ($get_berkas->berkas == NULL) {
		      $query = $this->db->delete('konstitusi',['id'=>$id]);
			  return $query;
		   }
           else {
			  $query = $this->db->delete('konstitusi',['id'=>$id]);
			  if($query){
				$path = FCPATH . "uploads/".$get_berkas->berkas;
                unset($path);
			}
		  }
        }
	}
	public function get_all(){
		$this->db->select('*');
		$this->db->from('konstitusi');
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