<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berkas_proposal extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('BerkasproposalModel');
		$this->load->database();
	}
	public function index()
	{
		//dibawah $data penomeran digunkan untuk mendapatkan penomeran di tabel penomeran
		$data['penomoran'] = $this->BerkasproposalModel->get_penomoran();
        $this->load->view('template/header.php');
        $this->load->view('template/sidebar.php');
		$this->load->view('template/navbar.php'); //tidak ada $data berarti tidak ada data yang diambil
		$this->load->view('admin/surat/berkas_proposal/view.php',$data); // $data digunakan untuk mengampil data2 yang telah diatur dan dikirim ke view ini
		$this->load->view('template/footer.php');
		$this->load->view('admin/surat/berkas_proposal/script.php');
	}
	public function get_all()
	{
		$berkas_proposal = $this->BerkasproposalModel->get_all();
		$data['berkas_proposal'] = $berkas_proposal;
		$this->load->view('admin/surat/berkas_proposal/data_berkas.php',$data);
	}
	
	public function crud($mode)
	{
		if ($mode == 'insert') {
			if ($this->input->is_ajax_request()) {
				$data = array(
					'id' => $this->input->post('id'),
					'id_penomoran' => $this->input->post('id_penomoran'),
					'nama_kegiatan' => $this->input->post('nama_kegiatan'),
					'link' => $this->input->post('link'),
					'tanggal_kegiatan' => $this->input->post('tanggal_kegiatan')
				);
				$result = $this->BerkasproposalModel->insert($data);
				echo json_encode($result);
			}
		}
		else if ($mode == 'update') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$data = array(
					'id' => $this->input->post('id'),
					'id_penomoran' => $this->input->post('id_penomoran'),
					'nama_kegiatan' => $this->input->post('nama_kegiatan'),
					'link' => $this->input->post('link'),
					'tanggal_kegiatan' => $this->input->post('tanggal_kegiatan')
				);
				$result = $this->BerkasproposalModel->update($data, $id);
				echo json_encode($result);
			}
		}
		else if ($mode == 'delete') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$result = $this->BerkasproposalModel->delete($id);
				echo json_encode($result);
			}
		}
	}
	public function get_by_id() {
		$id = $this->input->get('id');
		$data = $this->BerkasproposalModel->get_by_id($id);
		echo json_encode($data);
	}
}