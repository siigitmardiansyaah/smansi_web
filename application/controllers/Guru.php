<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Guru extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model('guru_m');
	}
    
	public function index()
	{
		$data['guru'] = $this->guru_m->getGuru();
		$this->session->set_flashdata('activemenu','guru');
 	   	$this->load->view('guru',$data);
	}

	function add() {
		$this->session->set_flashdata('activemenu','guru');
		$this->load->view('guru_add');
	}

	function store() {
		$nip = $this->input->post('nip');
		$nama = $this->input->post('nama');
		$password = md5($this->input->post('password'));
		$data = array(
			'nip' => $nip,
			'nama_guru' => $nama,
			'password' => $password
		);
		if(strlen($this->input->post('password')) < 1) {
			$this->session->set_flashdata('error','Data Guru Gagal Di Tambahkan');
			redirect('guru');
		} else {
			$query = $this->guru_m->insert($data);
			if($query) {
				$this->session->set_flashdata('success','Data Guru Berhasil Di Tambahkan');
				redirect('guru');
			}else{
				$this->session->set_flashdata('error','Data Guru Gagal Di Tambahkan');
				redirect('guru');
			}
		}
		
	}

	function edit($id) {
		$data['guru'] = $this->guru_m->getGuruProfile($id);
		$this->session->set_flashdata('activemenu','guru');
 	   	$this->load->view('guru_edit',$data);
	}

	function update() {
		$id = $this->input->post('id');
		$nip = $this->input->post('nip');
		$nama = $this->input->post('nama');
		$password = md5($this->input->post('password'));
		$data = array(
			'nip' => $nip,
			'nama_guru' => $nama,
			'password' => $password
		);
		
		if(strlen($this->input->post('password')) < 1) {
			$data = array(
				'nip' => $nip,
				'nama_guru' => $nama,
			);
			$query = $this->guru_m->update($data,$id);
			if($query) {
				$this->session->set_flashdata('success','Data Guru Berhasil Di Update');
				redirect('guru');
			}else{
				$this->session->set_flashdata('success','Data Guru Gagal Di Update');
				redirect('guru');
			}
		} else {
			$data = array(
				'nip' => $nip,
				'nama_guru' => $nama,
				'password' => $password
			);
			$query = $this->guru_m->update($data,$id);
			if($query) {
				$this->session->set_flashdata('success','Data Guru Berhasil Di Update');
				redirect('guru');
			}else{
				$this->session->set_flashdata('success','Data Guru Gagal Di Update');
				redirect('guru');
			}
		}
		
	}

	function hapus($id) {
		$query = $this->guru_m->hapus($id);
		if($query) {
			$this->session->set_flashdata('success','Data Guru Berhasil Di Hapus');
			redirect('guru');
		}else{
			$this->session->set_flashdata('success','Data Guru Gagal Di Hapus');
			redirect('guru');
		}
	}
	
}
