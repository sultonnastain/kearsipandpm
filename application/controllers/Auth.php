<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends CI_Controller {
public function __construct(){
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->model('model_user');
    $this->load->database();
}
public function index() {
$this->load->view('auth/login.php');
}
public function cek_login() {
$data = array('username' => $this->input->post('username', TRUE),
'password' => $this->input->post('password')
);
$hasil = $this->model_user->cek_user($data);
if ($hasil->num_rows() == 1) {

foreach ($hasil->result() as $sess) {
$sess_data['logged_in'] = 'Sudah Loggin';
$sess_data['id'] = $sess->id;
$sess_data['nama'] = $sess->nama;
$sess_data['username'] = $sess->username;
$sess_data['level'] = $sess->level;
$this->session->set_userdata($sess_data);
}
if ($this->session->userdata('level')=='kabiro') {
redirect('kabiro/kabiro');
}
elseif ($this->session->userdata('level')=='staff') {
redirect('staff/staff');
}
}
else {
echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
}
}
}
?>