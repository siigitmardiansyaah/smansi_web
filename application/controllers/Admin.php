<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model('admin_m');
	}
    
	public function index()
	{
		$data['mapel'] = $this->admin_m->countMapel();
		$data['siswa'] = $this->admin_m->countSiswa();
		$data['guru'] = $this->admin_m->countGuru();
		$data['kelas'] = $this->admin_m->countMapel();
		//$data['posts'] = $this->model->index();
		$this->session->set_flashdata('activemenu','admin');
 	   	$this->load->view('admin',$data);
	}
	
}
