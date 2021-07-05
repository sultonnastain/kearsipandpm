<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_surat extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('TemplatesuratModel');
		$this->load->library('upload');
		$this->load->helper('download');
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
				$config['max_size']             = 10240;
				$config['width']                = 300;
                $config['height']               = 400;
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
				$id = $this->input->get('id');
				if (!empty($_FILES["berkas"]["name"])) {
					$this->berkas = $this->_uploadBerkas();
				} else {
					$this->image = $post["old_image"];
				}
				$data = array(
					'id' => $this->input->post('id'),
					'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
					
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
			function _uploadBerkas()
			{
				$config['upload_path']         = './upload';
				$config['allowed_types']       = 'xls|docx|pdf';
				$config['file_name']           = $string->id;
				$config['overwrite']           = true;
				$config['max_size']            = 2000000;
				
				$this->load->library('upload' , $config);
		
				if ($this->upload->do_upload('berkas')) {
					return $this->upload->data("file name");
				}
				return "0";
			}
		}
		else if ($mode == 'dawnload') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$this->db->select('berkas');
				$this->db->from('template_surat');
				$this->db->where('id',$id);
				$template=$this->db->get();
				foreach($template->result() as $row) {
					$nama_file = $row->berkas;
				}
				$data = 'Here is some text!';
		         $name = 'mytext.txt';
		        force_download($name, $data);
			}
		}
	}
	public function get_by_id() {
		$id = $this->input->get('id');
		$data = $this->TemplatesuratModel->get_by_id($id);
		echo json_encode($data);
	}
}