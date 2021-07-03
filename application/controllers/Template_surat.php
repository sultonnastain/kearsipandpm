<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_surat extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('TemplatesuratModel');
		$this->load->database();
	}
	public function index()
	{
        $this->load->view('template/header.php');
        $this->load->view('template/sidebar.php');
		$this->load->view('template/navbar.php');
		$this->load->view('admin/surat/template_surat/view.php');
        $this->load->view('template/footer.php');
        $this->load->view('admin/surat/template_surat/script.php');
	}
	public function get_all()
	{
		$template_surat = $this->TemplatesuratModel->get_all();
		$data['template_surat'] = $template_surat;
		$this->load->view('admin/surat/template_surat/data_masuk.php',$data);
	}
	
	public function crud($mode)
	{
		if ($mode == 'insert') {
			if ($this->input->is_ajax_request()) {
				$data = array(
					'id' => $this->input->post('id'),
					'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
					'berkas' => $this->input->post('berkas'),
				);
				$result = $this->TemplatesuratModel->insert($data);
				echo json_encode($result);
			}
		}
		else if ($mode == 'update') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$data = array(
					'id' => $this->input->post('id'),
					'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
					'berkas' => $this->input->post('berkas'),
				);
				$result = $this->TemplatesuratModel->update($data, $id);
				echo json_encode($result);
			}
		}
		else if ($mode == 'delete') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$result = $this->TemplatesuratModel->delete($id);
				echo json_encode($result);
			}
		}
	}
	public function get_by_id() {
		$id = $this->input->get('id');
		$data = $this->TemplatesuratModel->get_by_id($id);
		echo json_encode($data);
	}
}