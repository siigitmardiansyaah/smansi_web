<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('AuthM');
	}

	public function index(){
	    if($this->session->userdata('authenticated')) {
    	  redirect('dashboard');
    	} else {
    	  $this->load->view('login');
    	}
	}

	public function login(){
    	$nip = $this->input->post('nip');
    	$password = md5($this->input->post('password')); 
    	$user = $this->AuthM->get($nip); 
		
		if(empty($user)){ 
			if($nip === 'admin') {
				if($password === md5('test')) {
					$session_admin = array(
						'authenticated'	=>	TRUE, 
						'username'			=>	'admin',
						'role'	=> 'admin'
					);
					$this->session->set_userdata($session_admin);
					redirect('admin');
				}else{
					$this->session->set_flashdata('message', 'Password salah');
					redirect('auth');
				}
			}else{
					$this->session->set_flashdata('message', 'Username tidak ditemukan');
					redirect('auth');
			}

    	} else {
    		if($password == $user->password){ 
        	$session = array(
        		'authenticated'	=>	TRUE,
				'id_guru'		=> $user->id_guru, 
        		'nip'			=>	$user->nip,
        		'nama_guru'	=>	$user->nama_guru,
				'role'	=> 'guru'

        	);

	        $this->session->set_userdata($session);
	        redirect('dashboard'); 
	    	} else {
	        	$this->session->set_flashdata('message', 'Password salah');
	        	redirect('auth');
	      	}
	    }
	}

	public function logout(){
		if (!empty($this->session->file)) {
		$un = $this->session->file;
		unlink($_SERVER['DOCUMENT_ROOT'].'/smansi_web/assets/qrimg/'.$un);
		}
		
		$this->session->sess_destroy();
		$this->session->set_flashdata('message', 'Anda telah keluar.');
		redirect('auth');
	}
}
