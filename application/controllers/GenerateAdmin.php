<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GenerateAdmin extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model('JadwalM');
		$this->load->model('QrM');
		$this->load->library('ciqrcode');
	}
    
	public function index()
	{
		if (!empty($this->session->file)) {
			unlink($_SERVER['DOCUMENT_ROOT'].'/smansi_web/assets/qrimg/'.$this->session->file);
			$this->session->unset_userdata('file');

		}
		$this->session->set_flashdata('activemenu','generate'); // Untuk active sidebar dinamis
 	   	$data['jadwal'] = $this->JadwalM->tampil_jadwal1();
 	   	$this->load->view('generate_admin', $data);
	}

	public function generated(){		
		$id_jadwal = $this->input->post('id_jadwal');
		if (!empty($id_jadwal)) {
			$this->db->trans_start();			
        	$data['datajadwal'] = $this->db->query("SELECT tbjadwal.id_jadwal as id_jadwal, tbjadwal.id_guru as id_guru, tbjadwal.waktu as waktu, tbkelas.nama_kelas as nama_kelas, tbmapel.nama_mapel as nama_mapel, tbmapel.id_mapel as id_mapel
			FROM tbjadwal
			JOIN tbkelas ON tbkelas.id_kelas = tbjadwal.id_kelas
			JOIN tbguru ON tbguru.id_guru = tbjadwal.id_guru
			JOIN tbmapel ON tbmapel.id_mapel = tbjadwal.id_mapel
			WHERE tbjadwal.id_jadwal = $id_jadwal ORDER BY waktu ASC")->result_array();

			$maxIDQR = $this->db->query("SELECT * FROM tbqr order by id_qr DESC")->row();
			
			if(empty($maxIDQR)) {
				$id_qrnew = 1;
			}else{
				$id_qrnew = $maxIDQR->id_qr + 1;
			}
		

        	foreach ($data as $dataJadwal) :
		      $datainsert = array(
		        "id_guru" => $dataJadwal[0]['id_guru'],
		        "qr"  => $qrRaw = $dataJadwal[0]['id_jadwal']."-".$id_qrnew."-".$dataJadwal[0]['nama_kelas']."-".$dataJadwal[0]['id_guru']."-".time()."-".$dataJadwal[0]['id_mapel']
		      );
		    endforeach;
			$this->db->trans_complete();						

		    $lokasiFileQr = $_SERVER['DOCUMENT_ROOT'].'/smansi_web/assets/qrimg/';
			$file_name = $qrRaw.".png";
			$tempdir = $lokasiFileQr.$file_name;
			QRcode::png($qrRaw,$tempdir,QR_ECLEVEL_H,15,0);
			$this->QrM->generateQr($datainsert);
			$infoQr = array(
				"fileQr"	=> $file_name,
				"qr"		=> $qrRaw,
			);	
			$this->session->set_userdata('file', $file_name);					
			$this->load->view('generated', $infoQr);
		} else {				
			redirect('generateadmin');
		}
	}
	
}