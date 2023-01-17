<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kelas extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model('kelas_m');
	}
    
	public function index()
	{
		$data['guru'] = $this->kelas_m->getKelas();
		$this->session->set_flashdata('activemenu','kelas');
 	   	$this->load->view('kelas',$data);
	}

	function add() {
		$this->session->set_flashdata('activemenu','kelas');
		$this->load->view('kelas_add');
	}

	function store() {
		$nama = $this->input->post('nama');
		$data = array(
			'nama_kelas' => $nama,
		);
			$query = $this->kelas_m->insert($data);
			if($query) {
				$this->session->set_flashdata('success','Data Kelas Berhasil Di Tambahkan');
				redirect('kelas');
			}else{
				$this->session->set_flashdata('error','Data Kelas Gagal Di Tambahkan');
				redirect('kelas');
			}
	}

	function edit($id) {
		$data['guru'] = $this->kelas_m->getGuruProfile($id);
		$this->session->set_flashdata('activemenu','kelas');
 	   	$this->load->view('keals_edit',$data);
	}

	function update() {
		$nama = $this->input->post('nama');
		$id = $this->input->post('id');
			$data = array(
				'nama_kelas' => $nama,
			);
			$query = $this->kelas_m->update($data,$id);
			if($query) {
				$this->session->set_flashdata('success','Data Kelas Berhasil Di Update');
				redirect('kelas');
			}else{
				$this->session->set_flashdata('success','Data Kelas Gagal Di Update');
				redirect('kelas');
			}
		
	}

	function hapus($id) {
		$query = $this->kelas_m->hapus($id);
		if($query) {
			$this->session->set_flashdata('success','Data Kelas Berhasil Di Hapus');
			redirect('kelas');
		}else{
			$this->session->set_flashdata('success','Data Kelas Gagal Di Hapus');
			redirect('kelas');
		}
	}
	
}
