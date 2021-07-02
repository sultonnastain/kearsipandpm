<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_keluar extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('SuratkeluarModel');
		$this->load->database();
	}
	public function index()
	{
		$data['penomoran'] = $this->SuratkeluarModel->get_penomoran();
        $this->load->view('template/header.php');
        $this->load->view('template/sidebar.php');
		$this->load->view('template/navbar.php');
		$this->load->view('admin/surat/surat_keluar/view.php',$data);
		$this->load->view('template/footer.php');
		$this->load->view('admin/surat/surat_keluar/script.php');
	}
	public function get_all()
	{
		$surat_keluar = $this->SuratkeluarModel->get_all();
		$data['surat_keluar'] = $surat_keluar;
		$this->load->view('admin/surat/surat_keluar/data_keluar.php',$data);
	}
	
	public function crud($mode)
	{
		if ($mode == 'insert') {
			if ($this->input->is_ajax_request()) {
				$data = array(
					'id' => $this->input->post('id'),
					'id_penomoran' => $this->input->post('id_penomoran'),
					'nama_dikirim' => $this->input->post('nama_dikirim'),
					'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
					'link' => $this->input->post('link'),
					'tanggal' => $this->input->post('tanggal')
				);
				$result = $this->SuratkeluarModel->insert($data);
				echo json_encode($result);
			}
		}
		else if ($mode == 'update') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$data = array(
					'id' => $this->input->post('id'),
					'id_penomoran' => $this->input->post('id_penomoran'),
					'nama_dikirim' => $this->input->post('nama_dikirim'),
					'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
					'link' => $this->input->post('link'),
					'tanggal' => $this->input->post('tanggal')
				);
				$result = $this->SuratkeluarModel->update($data, $id);
				echo json_encode($result);
			}
		}
		else if ($mode == 'delete') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$result = $this->SuratkeluarModel->delete($id);
				echo json_encode($result);
			}
		}
	}
	public function get_by_id() {
		$id = $this->input->get('id');
		$data = $this->SuratkeluarModel->get_by_id($id);
		echo json_encode($data);
	}
}