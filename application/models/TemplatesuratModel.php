<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class TemplatesuratModel extends CI_Model {
	public $table = 'template_surat';

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
		$get_surat = $this->db->get_where('template_surat',['id' => $id])->row();
        if ($get_surat){
           if ($get_surat->berkas == NULL) {
		      $query = $this->db->delete('template_surat',['id'=>$id]);
			  return $query;
		   }
           else {
			  $query = $this->db->delete('template_surat',['id'=>$id]);
			  if($query){
				$path = FCPATH . "uploads/".$get_surat->berkas;
                unset($path);
			}
		  }
        }
	}
	public function get_all(){
		$this->db->select('*');
		$this->db->from('template_surat');
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