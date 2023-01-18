<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koreksi_absen extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model('JadwalM');
		$this->load->model('QrM');
		$this->load->library('ciqrcode');
	}
    
	public function index()
	{
 	   	$data['jadwal'] = $this->JadwalM->tampil_jadwal($this->session->id_guru);
 	   	$this->load->view('tampil_kelas', $data);
	}

    function list_kelas()
    {
        $kelas = $this->input->post('id_jadwal');
        $data['kelas'] = $kelas;
        $data['siswa'] = $this->JadwalM->tampil_siswa($kelas,$this->session->id_guru);
        $this->load->view('tampil_siswa', $data);
    }

    function update_kehadiran($id,$id_qr)
    {
        $data['siswa'] = $this->JadwalM->getSiswa($id,$id_qr);
        $data['jadwal'] = $this->JadwalM->tampil_jadwal($this->session->id_guru);
        $this->load->view('koreksi', $data);
    }

    function update()
    {
        $id_siswa = $this->input->post('id_siswa');   
        $waktu = $this->input->post('waktu');
        $id_jadwal = $this->input->post('id_jadwal');
        $keterangan = $this->input->post('keterangan');
        $id_qr = $this->input->post('id_qr');
        $waktu1 = date('Y-m-d',strtotime($waktu));
        $getQR = $this->JadwalM->getQR($waktu1);
        $data = array(
            'waktu_absen' => $waktu,
            'keterangan' => $keterangan
        );
        $insert = $this->JadwalM->Insert($data,$id_jadwal,$id_qr,$id_siswa);
        if($insert)
        {
            redirect('rekapitulasi');
        }
    }
    

    public function add($id)
	{
        $id_guru = $this->session->id_guru;
        $data['mapel'] = $this->db->query("SELECT a.*,b.* from tbmapel a join tbjadwal b on a.id_mapel = b.id_mapel
        where b.id_jadwal = $id")->row();
        $data['siswa'] = $this->db->query("SELECT a.* from tbsiswa a join tbjadwal_siswa b on a.id_siswa = b.id_siswa
        join tbjadwal c on b.id_jadwal_guru = c.id_jadwal where c.id_guru = $id_guru")->result();
 	   	$this->load->view('add_absen', $data);
	}

    function add_update() {
        $id_guru = $this->session->id_guru;
        $id_siswa = $this->input->post('id_siswa');
        $id_jadwal = $this->input->post('id_jadwal');
        $waktu = $this->input->post('waktu');
        $keterangan = $this->input->post('keterangan');
        $waktu1 = date('Y-m-d',strtotime($waktu));

        $cekQR = $this->db->query("SELECT * from tbqr where DATE_FORMAT(waktu_buat, '%Y-%m-%d') like '%$waktu1%' AND id_guru = $id_guru order by waktu_buat DESC ")->row();

        $data = array(
            'id_jadwal' => $id_jadwal,
            'id_qr' => $cekQR->id_qr,
            'id_siswa' => $id_siswa,
            'waktu_absen' => $waktu,
            'keterangan' => $keterangan
        );
        $insert = $this->JadwalM->Insert1($data);
        if($insert)
        {
            redirect('rekapitulasi');
        }
    }

	
	
}