<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PengelolaanakunModel extends CI_Model {
	public $table = 'admin';

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
		$get_admin = $this->db->get_where('admin',['id' => $id])->row();
        if ($get_admin){
           if ($get_admin->foto == NULL) {
		      $query = $this->db->delete('admin',['id'=>$id]);
		   }
           else {
			  $query = $this->db->delete('admin',['id'=>$id]);
			  if($query){
				return unlink("foto_admin/".$get_admin->foto);
			}
		  }
        }
	}
	public function get_all(){
		$this->db->select('*');
		$this->db->from('admin');
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