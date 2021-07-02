<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_masuk extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
	}
	public function index()
	{
        $this->load->view('template/header.php');
        $this->load->view('template/sidebar.php');
		$this->load->view('template/navbar.php');
		$this->load->view('admin/surat/surat_masuk/view.php');
        $this->load->view('template/footer.php');
        $this->load->view('admin/surat/surat_masuk/script.php');
	}
	public function get_all()
	{
		$surat_masuk = $this->SuratmasukModel->get_all();
		$data['surat_masuk'] = $surat_masuk;
		$this->load->view('admin/surat/surat_masuk/data_masuk.php',$data);
	}
	
	public function crud($mode)
	{
		if ($mode == 'insert') {
			if ($this->input->is_ajax_request()) {
				$data = array(
					'id' => $this->input->post('id'),
					'nama_pengirim' => $this->input->post('nama_pengirim'),
					'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
					'link' => $this->input->post('link'),
					'tanggal' => $this->input->post('tanggal')
				);
				$result = $this->SuratmasukModel->insert($data);
				echo json_encode($result);
			}
		}
		else if ($mode == 'update') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$data = array(
					'id' => $this->input->post('id'),
					'nama_pengirim' => $this->input->post('nama_pengirim'),
					'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
					'link' => $this->input->post('link'),
					'tanggal' => $this->input->post('tanggal')
				);
				$result = $this->SuratmasukModel->update($data, $id);
				echo json_encode($result);
			}
		}
		else if ($mode == 'delete') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$result = $this->SuratmasukModel->delete($id);
				echo json_encode($result);
			}
		}
	}
	public function get_by_id() {
		$id = $this->input->get('id');
		$data = $this->SuratmasukModel->get_by_id($id);
		echo json_encode($data);
	}
}