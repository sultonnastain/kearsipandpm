<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penomoran extends CI_Controller {

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
		$this->load->view('admin/penomoran/view.php');
		$this->load->view('template/footer.php');
		$this->load->view('admin/penomoran/script.php');
	}
	public function get_all()
	{
		$penomoran = $this->PenomoranModel->get_all();
		$data['penomoran'] = $penomoran;
		$this->load->view('admin/penomoran/data_penomoran.php',$data);
	}
	
	public function crud($mode)
	{
		if ($mode == 'insert') {
			if ($this->input->is_ajax_request()) {
				$data = array(
					'id' => $this->input->post('id'),
					'nomor' => $this->input->post('nomor'),
					'nama_kegiatan' => $this->input->post('nama_kegiatan'),
					'penomoran' => $this->input->post('penomoran'),
					'jumlah' => $this->input->post('jumlah')
				);
				$result = $this->PenomoranModel->insert($data);
				echo json_encode($result);
			}
		}
		else if ($mode == 'update') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$data = array(
					'id' => $this->input->post('id'),
					'nomor' => $this->input->post('nomor'),
					'nama_kegiatan' => $this->input->post('nama_kegiatan'),
					'penomoran' => $this->input->post('penomoran'),
					'jumlah' => $this->input->post('jumlah')
				);
				$result = $this->PenomoranModel->update($data, $id);
				echo json_encode($result);
			}
		}
		else if ($mode == 'delete') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$result = $this->PenomoranModel->delete($id);
				echo json_encode($result);
			}
		}
	}
	public function get_by_id() {
		$id = $this->input->get('id');
		$data = $this->PenomoranModel->get_by_id($id);
		echo json_encode($data);
	}
}