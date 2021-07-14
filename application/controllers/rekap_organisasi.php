<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap_organisasi extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('RekaporganisasiModel');
		$this->load->library('upload');
		$this->load->database();
	}
	public function index()
	{
		$data['admin'] = $this->RekaporganisasiModel->get_admin();
        $this->load->view('template/header.php');
        $this->load->view('template/sidebar.php');
		$this->load->view('template/navbar.php');
		$this->load->view('admin/kas/rekap_organisasi/view.php',$data);
		$this->load->view('template/footer.php');
		$this->load->view('admin/kas/rekap_organisasi/script.php');
	}
	public function get_all()
	{
		$data['admin'] = $this->RekaporganisasiModel->get_admin();
		$rekap_organisasi = $this->RekaporganisasiModel->get_all();
		$data['rekap_organisasi'] = $rekap_organisasi;
		$this->load->view('admin/kas/rekap_organisasi/data_organisasi.php',$data);
	}
	
	public function crud($mode)
	{
		if ($mode == 'insert') {
			if ($this->input->is_ajax_request()) {
				$timezone = new DateTimeZone('Asia/Jakarta');
				$date = new DateTime();
				$date->setTimeZone($timezone);
				$config['upload_path']          = './uploads/';
				$config['allowed_types']        = 'pdf|doc|docx|xslsx';
				$config['max_size']             = 10240;
				$config['width']                = 300;
                $config['height']               = 400;
				$filename =  date("Y-m-d_His") . '-' . $_FILES['berkas']['name'];
				$config['file_name'] =$filename;
				$this->upload->initialize($config); 
				if($this->upload->do_upload("berkas")){ 
				$data = array(
					'id_admin' => $this->input->post('id_admin'),
					'bulan' => $this->input->post('bulan'),
					'berkas' => $filename,
					'keterangan' => $this->input->post('keterangan')
				);
				$result = $this->RekaporganisasiModel->insert($data);
				echo json_encode($result);
			}
		}
		}
		else if ($mode == 'update') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$data = array(
					'id_admin' => $this->input->post('id_admin'),
					'bulan' => $this->input->post('bulan'),
					'keterangan' => $this->input->post('keterangan')
				);
				if (empty($_FILES['berkas']['name'])) 
				{
				}
				else
				{	
					$patch = $this->db->get_where('rekap_organisasi',['id' => $id])->row();
					if($patch){
					  $path = FCPATH . "uploads/".$patch->berkas;
					  if(file_exists($path)){
						unset($path);
					  }else{
					  }
				    }
					$timezone = new DateTimeZone('Asia/Jakarta');
					$date = new DateTime();
					$date->setTimeZone($timezone);
					$config['upload_path']          = './uploads/';
					$config['allowed_types']        = 'pdf|doc|docx|xslsx';
					$config['max_size']             = 100240;
					$filename =  date("Y-m-d_His") . '-' . $_FILES['berkas']['name'];
					$config['file_name'] =$filename;
					$this->upload->initialize($config); 
					if($this->upload->do_upload("berkas")){ 
						$data['berkas'] = $filename;
					}
				}
				$result = $this->RekaporganisasiModel->update($data, $id);
				echo json_encode($result);
			}
		}
		else if ($mode == 'delete') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$result = $this->RekaporganisasiModel->delete($id);
				echo json_encode($result);
			}
		}
	}
	public function get_by_id() {
		$id = $this->input->get('id');
		$data = $this->RekaporganisasiModel->get_by_id($id);
		echo json_encode($data);
	}
	public function download($id){
		$this->load->helper('file'); // Load file helper
        $file = $this->db->get_where('rekap_organisasi',['id' => $id])->row();; //Get file by id
        $data = read_file(FCPATH . "uploads/".$patch->berkas); // Use file helper to read the file's
        $name = $file->berkas;
        force_download($name, $data);
	}
}