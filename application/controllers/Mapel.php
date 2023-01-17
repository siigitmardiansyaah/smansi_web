<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mapel extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model('mapel_m');
	}
    
	public function index()
	{
		$data['guru'] = $this->mapel_m->getKelas();
		$this->session->set_flashdata('activemenu','mapel');
 	   	$this->load->view('mapel',$data);
	}

	function add() {
		$this->session->set_flashdata('activemenu','mapel');
		$this->load->view('mapel_add');
	}

	function store() {
		$nama = $this->input->post('nama');
		$data = array(
			'nama_mapel' => $nama,
		);
			$query = $this->mapel_m->insert($data);
			if($query) {
				$this->session->set_flashdata('success','Data Mata Pelajaran Berhasil Di Tambahkan');
				redirect('mapel');
			}else{
				$this->session->set_flashdata('error','Data Mata Pelajaran Gagal Di Tambahkan');
				redirect('mapel');
			}
	}

	function edit($id) {
		$data['guru'] = $this->mapel_m->getGuruProfile($id);
		$this->session->set_flashdata('activemenu','mapel');
 	   	$this->load->view('mapel_edit',$data);
	}

	function update() {
		$nama = $this->input->post('nama');
		$id = $this->input->post('id');
			$data = array(
				'nama_mapel' => $nama,
			);
			$query = $this->mapel_m->update($data,$id);
			if($query) {
				$this->session->set_flashdata('success','Data Mata Pelajaran Berhasil Di Update');
				redirect('mapel');
			}else{
				$this->session->set_flashdata('success','Data Mata Pelajaran Gagal Di Update');
				redirect('mapel');
			}
		
	}

	function hapus($id) {
		$query = $this->mapel_m->hapus($id);
		if($query) {
			$this->session->set_flashdata('success','Data Mata Pelajaran Berhasil Di Hapus');
			redirect('mapel');
		}else{
			$this->session->set_flashdata('success','Data Mata Pelajaran Gagal Di Hapus');
			redirect('mapel');
		}
	}
	
}
