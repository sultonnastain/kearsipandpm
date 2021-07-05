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
		$rekap_anggota = $this->RekaporganisasiModel->get_all();
		$data['rekap_anggota'] = $rekap_anggota;
		$this->load->view('admin/kas/rekap_anggota/data_organisasi.php',$data);
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
					'id' => $this->input->post('id'),
					'id_admin' => $this->input->post('id_admin'),
					'bulan' => $this->input->post('bulan'),
					'berkas' => $filename,
					'keterangan' => $this->input->post('keterangan')
				);
				$result = $this->RekaporganisasiModel->insert($data);
				echo json_encode($result);
			}
		}
		else if ($mode == 'update') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				if (!empty($_FILES["berkas"]["name"])) {
					$this->berkas = $this->_uploadBerkas();
				} else {
					$this->image = $post["old_berkas"];
				}
				$data = array(
					'id' => $this->input->post('id'),
					'id_admin' => $this->input->post('id_admin'),
					'bulan' => $this->input->post('bulan'),
					'berkas' => $filename,
					'keterangan' => $this->input->post('keterangan')
				);
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
			function _uploadBerkas()
			{
				$config['upload_path']         = './upload';
				$config['allowed_types']       = 'xls|docx|pdf';
				$config['file_name']           = $string->id;
				$config['overwrite']           = true;
				$config['max_size']            = 2000000;
				
				$this->load->library('upload' , $config);
		
				if ($this->upload->do_upload('berkas')) {
					return $this->upload->data("file name");
				}
				return "0";
			}
		}
	}
	public function get_by_id() {
		$id = $this->input->get('id');
		$data = $this->RekaporganisasiModel->get_by_id($id);
		echo json_encode($data);
	}
}