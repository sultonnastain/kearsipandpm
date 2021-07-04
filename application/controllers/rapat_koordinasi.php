<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rapat_koordinasi extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('RapatkoordinasiModel');
		$this->load->database();
	}
	public function index()
	{
		$data['admin'] = $this->RapatkoordinasiModel->get_admin();
        $this->load->view('template/header.php');
        $this->load->view('template/sidebar.php');
		$this->load->view('template/navbar.php');
		$this->load->view('admin/absensi/rapat_koordinasi/view.php',$data);
		$this->load->view('template/footer.php');
		$this->load->view('admin/absensi/rapat_koordinasi/script.php');
	}
	public function get_all()
	{
		$data['admin'] = $this->RapatkoordinasiModel->get_admin();
		$rapat_koordinasi = $this->RapatkoordinasiModel->get_all();
		$data['rapat_koordinasi'] = $rapat_koordinasi;
		$this->load->view('admin/absensi/rapat_koordinasi/data_koordinasi.php',$data);
	}
	
	public function crud($mode)
	{
		if ($mode == 'insert') {
			if ($this->input->is_ajax_request()) {
				$data = array(
					'id' => $this->input->post('id'),
					'id_admin' => $this->input->post('id_admin'),
					'nama' => $this->input->post('nama'),
					'notulen' => $this->input->post('notulen'),
					'tanggal' => $this->input->post('tanggal')
				);
				$result = $this->RapatkoordinasiModel->insert($data);
				echo json_encode($result);
			}
		}
		else if ($mode == 'update') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$data = array(
					'id' => $this->input->post('id'),
					'id_admin' => $this->input->post('id_admin'),
					'nama' => $this->input->post('nama'),
					'notulen' => $this->input->post('notulen'),
					'tanggal' => $this->input->post('tanggal')
				);
				$result = $this->RapatkoordinasiModel->update($data, $id);
				echo json_encode($result);
			}
		}
		else if ($mode == 'delete') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$result = $this->RapatkoordinasiModel->delete($id);
				echo json_encode($result);
			}
		}
	}
	public function get_by_id() {
		$id = $this->input->get('id');
		$data = $this->RapatkoordinasiModel->get_by_id($id);
		echo json_encode($data);
	}
}