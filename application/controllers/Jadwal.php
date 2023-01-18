<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Jadwal extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model('jadwal_m');
	}
    
	public function index()
	{
		$data['guru'] = $this->jadwal_m->getGuru();
		$this->session->set_flashdata('activemenu','jadwal');
 	   	$this->load->view('jadwal',$data);
	}

	function add() {
		$data['kelas'] = $this->db->query('SELECT * FROM tbkelas order by id_kelas asc')->result();
		$data['mapel'] = $this->db->query('SELECT * FROM tbmapel order by id_mapel asc')->result();
		$data['guru'] = $this->db->query('SELECT * FROM tbguru order by id_guru asc')->result();
		$this->session->set_flashdata('activemenu','jadwal');
		$this->load->view('jadwal_add',$data);
	}

	function store() {
		$nip = $this->input->post('nip');
		$id_kelas = $this->input->post('id_kelas');
		$id_mapel = $this->input->post('id_mapel');
        $waktu = $this->input->post('waktu');
		$data = array(
			'id_mapel' => $id_mapel,
			'id_kelas' => $id_kelas,
            'id_guru' => $nip,
            'waktu' => $waktu
		);
			$query = $this->jadwal_m->insert($data);
			if($query) {
				$this->session->set_flashdata('success','Data Jadwal Guru Berhasil Di Tambahkan');
				redirect('jadwal');
			}else{
				$this->session->set_flashdata('error','Data Jadwal Guru Gagal Di Tambahkan');
				redirect('jadwal');
			}
		
	}

	function edit($id) {
		$data['guru1'] = $this->jadwal_m->getGuruProfile($id);
        $data['kelas'] = $this->db->query('SELECT * FROM tbkelas order by id_kelas asc')->result();
		$data['mapel'] = $this->db->query('SELECT * FROM tbmapel order by id_mapel asc')->result();
		$data['guru'] = $this->db->query('SELECT * FROM tbguru order by id_guru asc')->result();
        $this->session->set_flashdata('activemenu','jadwal');
 	   	$this->load->view('jadwal_edit',$data);
	}

	function update() {
		$id = $this->input->post('id');
        $nip = $this->input->post('nip');
		$id_kelas = $this->input->post('id_kelas');
		$id_mapel = $this->input->post('id_mapel');
        $waktu = $this->input->post('waktu');
		$data = array(
			'id_mapel' => $id_mapel,
			'id_kelas' => $id_kelas,
            'id_guru' => $nip,
            'waktu' => $waktu
		);
			$query = $this->jadwal_m->update($data,$id);
			if($query) {
				$this->session->set_flashdata('success','Data Jadwal Guru Berhasil Di Update');
				redirect('jadwal');
			}else{
				$this->session->set_flashdata('success','Data Jadwal Guru Gagal Di Update');
				redirect('jadwal');
			}
		
		
	}

	function hapus($id) {
		$query = $this->jadwal_m->hapus($id);
		if($query) {
			$this->session->set_flashdata('success','Data Jadwal Guru Berhasil Di Hapus');
			redirect('jadwal');
		}else{
			$this->session->set_flashdata('success','Data Jadwal Guru Gagal Di Hapus');
			redirect('jadwal');
		}
	}

    public function index_jadwal()
	{
		$data['guru'] = $this->jadwal_m->getSiswa();
		$this->session->set_flashdata('activemenu','jadwal_siswa');
 	   	$this->load->view('jadwal_siswa',$data);
	}

    function add_siswa() {
        $data['siswa'] = $this->db->query('SELECT * FROM tbsiswa order by id_siswa asc')->result();
		$data['kelas'] = $this->db->query('SELECT a.*,b.*,c.*,d.* FROM tbjadwal a 
        join tbguru b on a.id_guru = b.id_guru 
        join tbmapel c on a.id_mapel = c.id_mapel 
        join tbkelas d on a.id_kelas = d.id_kelas order by a.id_jadwal asc')->result();
		$this->session->set_flashdata('activemenu','jadwal_siswa');
		$this->load->view('jadwal_add_siswa',$data);
	}

	function store1() {
		$id_siswa = $this->input->post('id_siswa');
		$id_jadwal = $this->input->post('id_jadwal');
		$data = array(
			'id_siswa' => $id_siswa,
			'id_jadwal_guru' => $id_jadwal,
		);
			$query = $this->jadwal_m->insert1($data);
			if($query) {
				$this->session->set_flashdata('success','Data Jadwal Siswa Berhasil Di Tambahkan');
				redirect('jadwal/index_jadwal');
			}else{
				$this->session->set_flashdata('error','Data Jadwal Siswa Gagal Di Tambahkan');
				redirect('jadwal/index_jadwal');
			}
		
	}

    function edit_siswa($id) {
		$data['guru1'] = $this->jadwal_m->getGuruProfile1($id);
        $data['siswa'] = $this->db->query('SELECT * FROM tbsiswa order by id_siswa asc')->result();
		$data['kelas'] = $this->db->query('SELECT a.*,b.*,c.*,d.* FROM tbjadwal a 
        join tbguru b on a.id_guru = b.id_guru 
        join tbmapel c on a.id_mapel = c.id_mapel 
        join tbkelas d on a.id_kelas = d.id_kelas order by a.id_jadwal asc')->result();
        $this->session->set_flashdata('activemenu','jadwal_siswa');
 	   	$this->load->view('jadwal_siswa_edit',$data);
	}

    function update1() {
		$id = $this->input->post('id');
        $id_siswa = $this->input->post('id_siswa');
		$id_jadwal = $this->input->post('id_jadwal');
		$data = array(
			'id_siswa' => $id_siswa,
			'id_jadwal_guru' => $id_jadwal,
		);
			$query = $this->jadwal_m->update1($data,$id);
			if($query) {
				$this->session->set_flashdata('success','Data Jadwal Siswa Berhasil Di Update');
				redirect('jadwal/index_jadwal');
			}else{
				$this->session->set_flashdata('success','Data Jadwal siswa Gagal Di Update');
				redirect('jadwal/index_jadwal');
			}
		
		
	}

    function hapus1($id) {
		$query = $this->jadwal_m->hapus1($id);
		if($query) {
			$this->session->set_flashdata('success','Data Jadwal Siswa Berhasil Di Hapus');
			redirect('jadwal');
		}else{
			$this->session->set_flashdata('success','Data Jadwal Siswa Gagal Di Hapus');
			redirect('jadwal');
		}
	}
	
}
