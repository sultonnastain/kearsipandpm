<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_surat extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('TemplatesuratModel');
		$this->load->library('upload');
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
		$this->load->view('admin/surat/template_surat/data_template.php',$data);
	}
	
	public function crud($mode)
	{
		if ($mode == 'insert') {
			if ($this->input->is_ajax_request()) {
				$timezone = new DateTimeZone('Asia/Jakarta');
				$date = new DateTime();
				$date->setTimeZone($timezone);
				$config['upload_path']          = './uploads/';
				$config['allowed_types']        = 'pdf|doc|docx|xslsx';
				$config['max_size']             = 100240;
				$filename =  date("Y-m-d_His") . '-' . $_FILES['berkas']['name'];
				$config['file_name'] =$filename;
				$this->upload->initialize($config); 
				if($this->upload->do_upload("berkas")){ 
					$data = array(
						'id' => $this->input->post('id'),
						'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
						'berkas' => $filename,
					);
					$result = $this->TemplatesuratModel->insert($data);
					echo json_encode($result);
				}
			}
		}
		else if ($mode == 'update') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$data = array(
					'jenis_kegiatan' => $this->input->post('jenis_kegiatan')
				);
				if (empty($_FILES['berkas']['name'])) 
				{
				}
				else
				{	
					$patch = $this->db->get_where('template_surat',['id' => $id])->row();
					if($patch){
					  $path = FCPATH . "uploads/".$patch->berkas;
					  if(file_exists($path)){
						unset($path);
					  }else{
					  }
				    }
					$timezone = new DateTimeZone('Asia/Jakarta');
					$date = new DateTime();
					$date->setTimeZone($timezone);
					$config['upload_path']          = './uploads/';
					$config['allowed_types']        = 'pdf|doc|docx|xslsx';
					$config['max_size']             = 100240;
					$filename =  date("Y-m-d_His") . '-' . $_FILES['berkas']['name'];
					$config['file_name'] =$filename;
					$this->upload->initialize($config); 
					if($this->upload->do_upload("berkas")){ 
						$data['berkas'] = $filename;
					}
				}
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
	public function download($id){
		$this->load->helper('file'); // Load file helper
        $file = $this->db->get_where('template_surat',['id' => $id])->row();; //Get file by id
        $data = read_file(FCPATH . "uploads/".$patch->berkas); // Use file helper to read the file's
        $name = $file->berkas;
        force_download($name, $data);
	}
	public function get_by_id() {
		$id = $this->input->get('id');
		$data = $this->TemplatesuratModel->get_by_id($id);
		echo json_encode($data);
	}
}