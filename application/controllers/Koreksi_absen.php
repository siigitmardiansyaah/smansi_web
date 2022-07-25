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
 	   	$data['jadwal'] = $this->JadwalM->tampil_jadwal($this->session->nip);
 	   	$this->load->view('tampil_kelas', $data);
	}

    function list_kelas()
    {
        $kelas = $this->input->post('id_jadwal');
        $data['siswa'] = $this->JadwalM->tampil_siswa($kelas,$this->session->nip);
        $this->load->view('tampil_siswa', $data);
    }

    function update_kehadiran()
    {
        $data['siswa'] = $this->JadwalM->getSiswa($this->uri->segment(3));
        $data['jadwal'] = $this->JadwalM->tampil_jadwal($this->session->nip);
        $this->load->view('koreksi', $data);
    }

    function update()
    {
        $id_siswa = $this->input->post('id_siswa');   
        $waktu = $this->input->post('waktu');
        $id_jadwal = $this->input->post('id_jadwal');
        $keterangan = $this->input->post('keterangan');
        $waktu1 = date('Y-m-d',strtotime($waktu));
        $getQR = $this->JadwalM->getQR($waktu1);
        $data = array(
            'id_jadwal' => $id_jadwal,
            'id_qr' => $getQR->id_qr,
            'id_siswa' => $id_siswa,
            'waktu_absen' => $waktu,
            'keterangan' => $keterangan
        );
        $insert = $this->JadwalM->Insert($data);
        if($insert)
        {
            redirect('rekapitulasi');
        }
    }

	
	
}