<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekapitulasi extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model('AbsenM');
	}
    
	public function index()
	{
		$this->session->set_flashdata('activemenu','rekapitulasi');
		$data['rekap'] = $this->AbsenM->tampil_rekapitulasi($this->session->id_guru);
		$data['kelas'] = $this->AbsenM->info_kelas($this->session->id_guru);
 	   	$this->load->view('rekapitulasi',$data);
	}

	public function cetak()
	{
		if (!empty($_POST['kelas'])) {
		$kelas = $_POST['kelas'];
		$data ['kelas'] = $this->db->query("SELECT * FROM tbkelas where id_kelas = $kelas")->row();
		$data['cetak'] = $this->AbsenM->cetak_rekapitulasi($kelas);
    	$this->load->view('cetak_rekapitulasi',$data);
    	}else {
    		redirect('rekapitulasi');
    	}
	}
	
}
