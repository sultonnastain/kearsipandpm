<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengelolaan_akun extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('PengelolaanakunModel');
		$this->load->database();
	}
	public function index()
	{
        $this->load->view('template/header.php');
        $this->load->view('template/sidebar.php');
		$this->load->view('template/navbar.php');
		$this->load->view('admin/pengelolaan_akun/view.php');
		$this->load->view('template/footer.php');
		$this->load->view('admin/pengelolaan_akun/script.php');
	}
	public function get_all()
	{
		$admin = $this->PengelolaanakunModel->get_all();
		$data['admin'] = $admin;
		$this->load->view('admin/pengelolaan_akun/data_akun.php',$data);
	}
	
	public function crud($mode)
	{
		if ($mode == 'insert') {
			if ($this->input->is_ajax_request()) {
				$data = array(
					'id' => $this->input->post('id'),
					'nama' => $this->input->post('nama'),
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password'),
					'level' => $this->input->post('level')
				);
				$result = $this->PengelolaanakunModel->insert($data);
				echo json_encode($result);
			}
		}
		else if ($mode == 'update') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$data = array(
					'id' => $this->input->post('id'),
					'nama' => $this->input->post('nama'),
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password'),
					'level' => $this->input->post('level')
				);
				$result = $this->PengelolaanakunModel->update($data, $id);
				echo json_encode($result);
			}
		}
		else if ($mode == 'delete') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$result = $this->PengelolaanakunModel->delete($id);
				echo json_encode($result);
			}
		}
	}
	public function get_by_id() {
		$id = $this->input->get('id');
		$data = $this->PengelolaanakunModel->get_by_id($id);
		echo json_encode($data);
	}
}