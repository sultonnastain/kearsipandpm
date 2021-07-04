<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rapat_pleno extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('RapatplenoModel');
		$this->load->database();
	}
	public function index()
	{
		$data['admin'] = $this->RapatplenoModel->get_admin();
        $this->load->view('template/header.php');
        $this->load->view('template/sidebar.php');
		$this->load->view('template/navbar.php');
		$this->load->view('admin/absensi/rapat_pleno/view.php',$data);
		$this->load->view('template/footer.php');
		$this->load->view('admin/absensi/rapat_pleno/script.php');
	}
	public function get_all()
	{
		$data['admin'] = $this->RapatplenoModel->get_admin();
		$rapat_pleno = $this->RapatplenoModel->get_all();
		$data['rapat_pleno'] = $rapat_pleno;
		$this->load->view('admin/absensi/rapat_pleno/data_pleno.php',$data);
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
				$result = $this->RapatplenoModel->insert($data);
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
				$result = $this->RapatplenoModel->update($data, $id);
				echo json_encode($result);
			}
		}
		else if ($mode == 'delete') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$result = $this->RapatplenoModel->delete($id);
				echo json_encode($result);
			}
		}
	}
	public function get_by_id() {
		$id = $this->input->get('id');
		$data = $this->RapatplenoModel->get_by_id($id);
		echo json_encode($data);
	}
}