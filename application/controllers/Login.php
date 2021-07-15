<?php
class Login extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('session');
    }
    function index(){
        $this->load->view('auth/login');
    }
    function auth(){
        $username=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
        $password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);
 
        $cek_log=$this->login_model->auth($username,$password);
 
        if($cek_log->num_rows() > 0){ //jika login sebagai dosen
                $data=$cek_log->row_array();
                $this->session->set_userdata('masuk',TRUE);
                $this->session->set_userdata('level',$data['level']);
                $this->session->set_userdata('nama',$data['nama']);
                redirect('dashboard');
                //  if($data['level']=='1'){ //Akses admin
                //     // $this->session->set_userdata('akses','1');
                //     // $this->session->set_userdata('ses_id',$data['nip']);
                //     // $this->session->set_userdata('ses_nama',$data['nama']);
                //     redirect('page');
 
                //  }else{ //akses dosen
                //     // $this->session->set_userdata('akses','2');
                //     //             $this->session->set_userdata('ses_id',$data['nip']);
                //     // $this->session->set_userdata('ses_nama',$data['nama']);
                //     redirect('page');
                //  }
        }else{
            redirect('login');
        }
    }
    function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
}