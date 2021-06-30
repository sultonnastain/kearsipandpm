<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rapat_pleno extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
	}
	public function index()
	{
        $this->load->view('template/header.php');
        $this->load->view('template/sidebar.php');
		$this->load->view('template/navbar.php');
		$this->load->view('admin/absensi/rapat_pleno/view.php');
		$this->load->view('template/footer.php');
		$this->load->view('admin/absensi/rapat_pleno/script.php');
	}
}