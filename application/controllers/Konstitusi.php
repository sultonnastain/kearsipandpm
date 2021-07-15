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
					'id_penomoran' => $this->input->post('id_penomoran'),
					'nama_konstitusi' => $this->input->post('nama_konstitusi'),
					'berkas' => $filename,
					'tanggal' => $this->input->post('tanggal')
				);
				$result = $this->KonstitusiModel->insert($data);
				echo json_encode($result);
			}
		}
	}
	else if ($mode == 'update') {
		if ($this->input->is_ajax_request()) {
			$id = $this->input->post('id');
			$data = array(
				'id_penomoran' => $this->input->post('id_penomoran'),
				'nama_konstitusi' => $this->input->post('nama_konstitusi'),
				'tanggal' => $this->input->post('tanggal')
			);
			if (empty($_FILES['berkas']['name'])) 
			{
			}
			else
			{	
				$patch = $this->db->get_where('konstitusi',['id' => $id])->row();
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
		}
}
	public function get_by_id () {
		$id = $this->input->get('id');
		$data = $this->KonstitusiModel->get_by_id($id);
		echo json_encode($data);
	}
	public function download($id){
		$this->load->helper('file'); // Load file helper
        $file = $this->db->get_where('konstitusi',['id' => $id])->row();; //Get file by id
        $data = read_file(FCPATH . "uploads/".$patch->berkas); // Use file helper to read the file's
        $name = $file->berkas;
        force_download($name, $data);
	}
		
}