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
				$config['upload_path']          = './foto_admin';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 10240;
				$config['width']                = 300;
                $config['height']               = 400;
				$filename = date("Y-m-d_His") . '-' . $_FILES['foto']['name'];
				$config['file_name'] = $filename;
				$this->upload->initialize($config); 
				if($this->upload->do_upload("foto")){ 
					$gbr = $this->upload->data();
					$config['image_library']='gd2';
					$config['source_image']='./foto_admin/'.$gbr['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '100%';
					$config['width']= 400;
					$config['height']= 600;
					$config['new_image']= './foto_admin/'.$gbr['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$data = array(
						'nama' => $this->input->post('nama'),
						'username' => $this->input->post('username'),
						'password' => $this->input->post('password'),
						'level' => $this->input->post('level'),
						'foto' => $gbr['file_name'],
					);
					$result = $this->PengelolaanakunModel->insert($data); //kirim value ke model m_upload
					echo json_decode($result);
				}
		}
		else if ($mode == 'update') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$data = array(
					'nisn' => $this->input->post('nisn'),
					'email' => $this->input->post('email'),
					'nama' => $this->input->post('nama'),
                    'j_kelamin' => $this->input->post('jkelamin'),
                    'tempat_lahir' => $this->input->post('tempatlahir'),
					'tanggal_lahir' => $this->input->post('tanggallahir'),
					'tahun_masuk' => $this->input->post('tahunmasuk'),
					'id_agama' => $this->input->post('agama')
				);
				if (empty($_FILES['foto']['name'])) 
				{
					// $data['foto']=harus null biar bisa diinsert
				}
				else
				{	
					$patch = $this->db->get_where('siswa',['nis' => $id])->row();
					if($patch){
					  if(file_exists("uploads/siswa/".$patch->foto)){
						unlink("uploads/siswa/".$patch->foto);
					  }else{
					  }
				    }
					$config['upload_path']          = './uploads/siswa';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 10240;
					$config['width']                = 300;
					$config['height']               = 400;
					$filename = $this->input->post('nis');
					$config['file_name'] = $filename;
					$this->upload->initialize($config); 
					if($this->upload->do_upload("foto")){ 
						$gbr = $this->upload->data();
						$config['image_library']='gd2';
						$config['source_image']='./uploads/siswa/'.$gbr['file_name'];
						$config['create_thumb']= FALSE;
						$config['maintain_ratio']= FALSE;
						$config['quality']= '100%';
						$config['width']= 400;
						$config['height']= 600;
						$config['new_image']= './uploads/siswa/'.$gbr['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$data['foto'] = $gbr['file_name'];
					}
				}
				$result = $this->SiswaModel->update($data, $id);
				echo json_decode($result);
			}
		}
		else if ($mode == 'delete') {
			if ($this->input->is_ajax_request()) {
				$id = $this->input->post('id');
				$result = $this->SiswaModel->delete($id);
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