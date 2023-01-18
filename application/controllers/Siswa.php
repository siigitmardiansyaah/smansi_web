<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Siswa extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model('siswa_m');
	}
    
	public function index()
	{
		$data['guru'] = $this->siswa_m->getGuru();
		$this->session->set_flashdata('activemenu','siswa');
 	   	$this->load->view('siswa',$data);
	}

	function add() {
		$data['kelas'] = $this->db->query('SELECT * FROM tbkelas order by id_kelas asc')->result();
		$this->session->set_flashdata('activemenu','siswa');
		$this->load->view('siswa_add',$data);
	}

	function store() {
		$nama = $this->input->post('nama');
		$nis = $this->input->post('nis');
		$id_kelas = $this->input->post('id_kelas');
		$no_wa = $this->input->post('no_wa');
		$data = array(
			'nis' => $nis,
			'nama' => $nama,
            'id_kelas' => $id_kelas,
            'no_wa' => $no_wa,
		);
			$query = $this->siswa_m->insert($data);
			if($query) {
				$this->session->set_flashdata('success','Data Siswa Berhasil Di Tambahkan');
				redirect('siswa');
			}else{
				$this->session->set_flashdata('error','Data Siswa Gagal Di Tambahkan');
				redirect('siswa');
			}
		
	}

	function edit($id) {
		$data['guru'] = $this->siswa_m->getGuruProfile($id);
		$data['kelas'] = $this->db->query('SELECT * FROM tbkelas order by id_kelas asc')->result();
		$this->session->set_flashdata('activemenu','siswa');
 	   	$this->load->view('siswa_edit',$data);
	}

	function update() {
		$id = $this->input->post('id');
        $nama = $this->input->post('nama');
		$nis = $this->input->post('nis');
		$id_kelas = $this->input->post('id_kelas');	
		$no_wa = $this->input->post('no_wa');	
			$data = array(
				'nis' => $nis,
				'nama' => $nama,
				'id_kelas' => $id_kelas,
				'no_wa' => $no_wa,
			);
			$query = $this->siswa_m->update($data,$id);
			if($query) {
				$this->session->set_flashdata('success','Data Siswa Berhasil Di Update');
				redirect('siswa');
			}else{
				$this->session->set_flashdata('success','Data Siswa Gagal Di Update');
				redirect('siswa');
			}
		
		
	}

	function hapus($id) {
		$query = $this->siswa_m->hapus($id);
		if($query) {
			$this->session->set_flashdata('success','Data Siswa Berhasil Di Hapus');
			redirect('siswa');
		}else{
			$this->session->set_flashdata('success','Data Siswa Gagal Di Hapus');
			redirect('siswa');
		}
	}
	
}
