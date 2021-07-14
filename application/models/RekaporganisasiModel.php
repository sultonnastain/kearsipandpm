<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class RekaporganisasiModel extends CI_Model {
	public $table = 'rekap_organisasi';

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
		$get_berkas = $this->db->get_where('rekap_organisasi',['id' => $id])->row();
        if ($get_berkas){
           if ($get_berkas->berkas == NULL) {
		      $query = $this->db->delete('rekap_organisasi',['id'=>$id]);
			  return $query;
		   }
           else {
			  $query = $this->db->delete('rekap_organisasi',['id'=>$id]);
			  if($query){
				$path = FCPATH . "uploads/".$get_berkas->berkas;
                unset($path);
			}
		  }
        }
	}
	public function get_all(){
		$this->db->select('r.*,a.nama as nama_admin');
		$this->db->from('rekap_organisasi r');
		$this->db->join('admin a','a.id=r.id_admin');
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
	public function get_admin(){
		$this->db->select('*');
		$this->db->from('admin');
		return $this->db->get()->result();
	}
}
?>