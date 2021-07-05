<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konstitusi extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('KonstitusiModel');
		$this->load->library('upload');
		$this->load->database();
	}
	public function index()
	{
		$data['penomoran'] = $this->KonstitusiModel->get_penomoran();
        $this->load->view('template/header.php');
        $this->load->view('template/sidebar.php');
		$this->load->view('template/navbar.php');
		$this->load->view('admin/konstitusi/view.php',$data);
		$this->load->view('template/footer.php');
		$this->load->view('admin/konstitusi/script.php');
	}
	public function get_all()
	{
		$data['penomoran'] = $this->KonstitusiModel->get_penomoran();
		$konstitusi = $this->KonstitusiModel->get_all();
		$data['konstitusi'] = $konstitusi;
		$this->load->view('admin/konstitusi/data_konstitusi.php',$data);
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
					'id_penomoran' => $this->input->post('id_penomoran'),
					'nama_konstitusi' => $this->input->post('nama_konstitusi'),
					'berkas' => $filename,
					'tanggal' => $this->input->post('tanggal')
				);
				$result = $this->KonstitusiModel->insert($data);
				echo json_encode($result);
			}
		}
		else if ($mode == 'update') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				if (!empty($_FILES["berkas"]["name"])) {
					$this->berkas = $this->_uploadBerkas();
				} else {
					$this->image = $post["old_berkas"];
				}
				$data = array(
					'id' => $this->input->post('id'),
					'id_penomoran' => $this->input->post('id_penomoran'),
					'nama_konstitusi' => $this->input->post('nama_konstitusi'),
					'berkas' => $filename,
					'tanggal' => $this->input->post('tanggal')
				);
				$result = $this->KonstitusiModel->update($data, $id);
				echo json_encode($result);
			}
		}
		else if ($mode == 'delete') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$result = $this->KonstitusiModel->delete($id);
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
	}
}
	public function get_by_id () {
		$id = $this->input->get('id');
		$data = $this->KonstitusiModel->get_by_id($id);
		echo json_encode($data);
	}
		
}