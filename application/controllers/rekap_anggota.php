<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap_anggota extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('RekapanggotaModel');
		$this->load->database();
	}
	public function index()
	{
		$data['admin'] = $this->RekapaggotaModel->get_admin();
        $this->load->view('template/header.php');
        $this->load->view('template/sidebar.php');
		$this->load->view('template/navbar.php');
		$this->load->view('admin/kas/rekap_anggota/view.php',$data);
		$this->load->view('template/footer.php');
		$this->load->view('admin/kas/rekap_anggota/script.php');
	}
	public function get_all()
	{
		$data['admin'] = $this->RekapanggotaModel->get_admin();
		$rekap_anggota = $this->RekapanggotaModel->get_all();
		$data['rekap_anggota'] = $rekap_anggota;
		$this->load->view('admin/kas/rekap_anggota/data_anggota.php',$data);
	}
	
	public function crud($mode)
	{
		if ($mode == 'insert') {
			if ($this->input->is_ajax_request()) {
				$data = array(
					'id' => $this->input->post('id'),
					'id_admin' => $this->input->post('id_admin'),
					'nama' => $this->input->post('nama'),
					'tunggakan' => $this->input->post('tunggakan'),
					'total' => $this->input->post('total'),
					'status' => $this->input->post('status'),
				);
				$result = $this->RekapanggotaModel->insert($data);
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
					'tunggakan' => $this->input->post('tunggakan'),
					'total' => $this->input->post('total'),
					'status' => $this->input->post('status'),
				);
				$result = $this->RekapanggotaModel->update($data, $id);
				echo json_encode($result);
			}
		}
		else if ($mode == 'delete') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$result = $this->RekapanggotaModel->delete($id);
				echo json_encode($result);
			}
		}
	}
	public function get_by_id() {
		$id = $this->input->get('id');
		$data = $this->RekapanggotaModel->get_by_id($id);
		echo json_encode($data);
	}
}