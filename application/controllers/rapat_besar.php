<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rapat_besar extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('RapatbesarModel');
		$this->load->database();
	}
	public function index()
	{
		$data['admin'] = $this->RapatbesarModel->get_admin();
        $this->load->view('template/header.php');
        $this->load->view('template/sidebar.php');
		$this->load->view('template/navbar.php');
		$this->load->view('admin/absensi/rapat_besar/view.php',$data);
		$this->load->view('template/footer.php');
		$this->load->view('admin/absensi/rapat_besar/script.php');
	}
	public function get_all()
	{
		$data['admin'] = $this->RapatbesarModel->get_admin();
		$rapat_besar = $this->RapatbesarModel->get_all();
		$data['rapat_besar'] = $rapat_besar;
		$this->load->view('admin/absensi/rapat_besar/data_besar.php',$data);
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
				$result = $this->RapatbesarModel->insert($data);
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
				$result = $this->RapatbesarModel->update($data, $id);
				echo json_encode($result);
			}
		}
		else if ($mode == 'delete') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$result = $this->RapatbesarModel->delete($id);
				echo json_encode($result);
			}
		}
	}
	public function get_by_id() {
		$id = $this->input->get('id');
		$data = $this->RapatbesarModel->get_by_id($id);
		echo json_encode($data);
	}
}