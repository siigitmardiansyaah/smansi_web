<?php
date_default_timezone_set("Asia/Jakarta");
// extends class Model
class AbsenM extends CI_Model{

  // response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong';
    return $response;
  }

  // function untuk insert data ke tabel tbabsen
  public function add_absen($id_jadwal, $id_qr, $id_siswa,$long_gps,$lan_gps){
    $radius_bumi = 6371;
    // LOKASI USER
      $lat_user =  ($lan_gps * 3.14) / 180;
      $long_user = ($long_gps * 3.14) / 180;
    // LOKASI USER

    // LOKASI SEKOLAH
      $lat_sekolah = (-6.256727 * 3.14) / 180;
      $long_sekolah = (107.040846 * 3.14) / 180;
    // LOKASI SEKOLAH

    // RUMUS HARVERSINE
      $lat = $lat_sekolah - ($lat_user);
      $long = $long_sekolah - $long_user;
      $a = (sin($lat / 2) * sin($lat / 2))  + cos($lat_user) * cos($lat_sekolah) * (sin($long/2) * sin($long/2));
      $c = 2 * asin(sqrt($a));
      $jarak = $radius_bumi * 2 * $c;
      $banding = floor($jarak * 1000);
    // RUMUS HARVERSINE

    if($banding > 5)
    {
      $response['status']=502;
      $response['error']=true;
      $response['message']="Jarak anda $banding Meter,terlalu jauh untuk absen";
      return $response;
    }else{
      $query1 = $this->db->query("SELECT * FROM tbjadwal where id_jadwal = $id_jadwal")->row();
      $hari = date('l',strtotime($query1->waktu));
      $jam_mulai =date('H:i:s',strtotime($query1->waktu));
      $jam_selesai1 = date('H:i:s',strtotime($jam_mulai.'+1 hour'.'+30 minutes'));
      $hari_ini = date('l');
      $jam_sekarang = date('H:i:s');
      $query = $this->db->query("SELECT * from tbabsen where id_jadwal = $id_jadwal AND id_qr = $id_qr AND id_siswa = $id_siswa")->num_rows();
      $cekSiswa = $this->db->query("SELECT * from tbjadwal_siswa where id_siswa = $id_siswa AND id_jadwal_guru = $id_jadwal")->row();
      if($query == 0)
      {
      if($hari != $hari_ini){
        $response['status']=502;
        $response['error']=true;
        $response['message']='Tidak Bisa Absen Dikarenakan Beda Hari';
        return $response;
      }else if($hari == $hari_ini && $jam_sekarang < $jam_mulai)
        {
          $response['status']=502;
          $response['error']=true;
          $response['message']='Tidak Bisa Absen Dikarenakan  Kurang dari Jam Absen';
          return $response;
      }else if($hari == $hari_ini && $jam_sekarang > $jam_selesai1){
        $response['status']=502;
        $response['error']=true;
        $response['message']='Tidak Bisa Absen Dikarenakan  Lebih dari Jam Absen';      
      }else if($hari == $hari_ini && $jam_sekarang > $jam_mulai && $jam_sekarang < $jam_selesai1){
        if(empty($cekSiswa)) {
          $response['status']=502;
          $response['error']=true;
          $response['message']='Anda Tidak Bisa Absen Karena Beda Guru';
          return $response;
        }else{
          $data = array(
            "id_jadwal"=>$id_jadwal,
            "id_qr"=>$id_qr,
            "id_siswa"=>$id_siswa,
            "waktu_absen" =>date('Y-m-d h:i:s'),
            "keterangan" => 'Hadir'
          );
          $insert = $this->db->insert("tbabsen", $data);
          $siswa = $this->db->query("select * from tbsiswa where id_siswa = '$id_siswa'")->row();
          $mapel = $this->db->query("select a.*,b.* from tbjadwal a join tbmapel b on a.id_mapel = b.id_mapel where a.id_jadwal = '$id_jadwal'")->row();
          if($insert){
            $response['status']=200;
            $response['error']=false;
            $response['message']='Data absen ditambahkan.';
            $pukul = date('d/m/Y H:i:s');
            // WA TO RM
            $pesanNotif = "*Kehadira Siswa*
            \nDear Orang Tua *$siswa->nama*, 
            \nAnak Anda *$siswa->nama* Telah Hadir di Mata Pelajaran *$mapel->nama_mapel* Pada $pukul
            \nTerima Kasih
            \n*IT System SMK Telekomunikasi Telesandi Bekasi* 
            \n_NB : mohon untuk tidak membalas pesan ini_";
            sendWA($siswa->no_wa,$pesanNotif);
          // WA TO RM            
            return $response;
          }else{
            $response['status']=502;
            $response['error']=true;
            $response['message']='Data absen gagal ditambahkan.';
            return $response;
          }
        }  
      }
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Anda Sudah Absen Sebelumnya';
        return $response;
      }
    }
  }

  // mengambil semua data absen
  public function all_absen($id_siswa,$id_mapel){
    $this->db->select("a.keterangan, DATE_FORMAT(a.waktu_absen, '%W, %H:%i') as waktu_absen");
    $this->db->join("tbjadwal b",'a.id_jadwal = b.id_jadwal');
    $this->db->join("tbqr c","a.id_qr = c.id_qr");
    $this->db->join("tbsiswa d",'a.id_siswa = d.id_siswa');
    $this->db->where("b.id_mapel",$id_mapel);
    $this->db->where("a.id_siswa",$id_siswa);
    $all = $this->db->get("tbabsen a")->result();
    $response['status']=200;
    $response['error']=false;
    $response['absen']=$all;
    return $response;
  }

  // mengambil data absen berdasarkan id_absen tertentu
  public function the_absen($id_absen){
    if($id_absen == ''){
      $all = $this->db->get("tbabsen")->result();
      $response['status']=200;
      $response['error']=false;
      $response['absen']=$all;
      return $response;
    }else{
      $where = array(
        "id_absen"=>$id_absen
      );
      $this->db->where($where);
      $theid = $this->db->get("tbabsen")->result();
      if($theid){
        $response['status']=200;
        $response['error']=false;
        $response['absen']=$theid;
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data absen gagal ditampilkan.';
        return $response;
      }
    }
  }


  // mengambil data absen berdasarkan nis tertentu
  public function riwayat_absen($nis){
    if($nis == ''){
      return $this->empty_response();
    }else{
      $this->db->select('tbabsen.waktu_absen_absen as waktu, tbmapel.nama_mapel as nama_mapel, tbguru.nama_guru as nama_dosen');
      $this->db->from('tbjadwal');
      $this->db->join('tbmapel','tbmapel.id_mapel = tbjadwal.id_mapel');
      $this->db->join('tbguru', 'tbguru.id_guru = tbjadwal.id_guru');
      $this->db->join('tbkelas','tbkelas.id_kelas = tbjadwal.id_kelas');
      $this->db->join('tbabsen','tbabsen.id_jadwal = tbjadwal.id_jadwal');
      $this->db->join('tbsiswa', 'tbsiswa.nis = tbabsen.id_siswa');
      $this->db->join('tbqr', 'tbqr.id_qr = tbabsen.id_qr');
      $this->db->where('tbabsen.id_siswa', $nis);
      $theid = $this->db->get()->result();
      if($theid){
        return $theid;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data absen gagal ditampilkan.';
        return $response;
      }
    }
  }

  // cek apakah sudah absen
  public function cek_absen($nis, $id_qr, $id_jadwal){
    if(empty($nis) || empty($id_qr) || empty($id_jadwal)){
      return $this->empty_response();
    }else{
      $where = array(
        "nis"=>$nis,
        "id_qr"=>$id_qr,
        "id_jadwal"=>$id_jadwal
      );
      $this->db->where($where);
      $theid = $this->db->get("tbabsen")->result();
      if($theid){
        $response['status']=200;
        $response['error']=false;
        $response['absen']=$theid;
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data absen gagal ditampilkan.';
        return $response;
      }
    }
  }

  
  // hapus data absen
  public function delete_absen($id_absen){
    if($id_absen == ''){
      return $this->empty_response();
    }else{
      $where = array(
        "id_absen"=>$id_absen
      );
      $this->db->where($where);
      $delete = $this->db->delete("tbabsen");
      if($delete){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data absen dihapus.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data absen gagal dihapus.';
        return $response;
      }
    }
  }

  // update absen
  public function update_absen($id_absen, $id_jadwal, $id_qr, $nis, $waktu){
    if( empty($id_absen) || empty($id_jadwal) || $id_qr == '' || empty($nis) || empty($waktu) ){
      return $this->empty_response();
    }else{
      $where = array(
        "id_absen"=>$id_absen
      );
      $set = array(
        "id_jadwal"=>$id_jadwal,
        "id_qr"=>$id_qr,
        "nis"=>$nis,
        "waktu"=>$waktu
      );
      $this->db->where($where);
      $update = $this->db->update("tbabsen",$set);
      if($update){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data absen diubah.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data absen gagal diubah.';
        return $response;
      }
    }
  }

  //riwayat generate qr
   public function tampil_riwayat($nip){    
    $this->db->select('tbmapel.nama_mapel, tbqr.waktu_buat, tbkelas.nama_kelas');
    $this->db->from('tbjadwal');
    $this->db->group_by('tbqr.id_qr');    
    $this->db->join('tbmapel','tbmapel.id_mapel = tbjadwal.id_mapel');
    $this->db->join('tbkelas','tbkelas.id_kelas = tbjadwal.id_kelas');
    $this->db->join('tbqr','tbqr.id_guru = tbjadwal.id_guru');
    $this->db->where('tbjadwal.id_guru',$nip);
    $result = $this->db->get();
    return $result->result_array();
  }

  public function riwayat_generate($nip){
    $this->db->select('tbjadwal.id_guru as nip,tbmapel.nama_mapel as matkul, tbabsen.waktu_absen as waktu');
    $this->db->from('tbjadwal');      
    $this->db->group_by('tbabsen.id_qr');
    $this->db->order_by('tbabsen.id_absen','desc');
    $this->db->join('tbmapel','tbmapel.id_mapel = tbjadwal.id_mapel');
    $this->db->join('tbkelas','tbkelas.id_kelas = tbjadwal.id_kelas');
    $this->db->join('tbabsen','tbabsen.id_jadwal = tbjadwal.id_jadwal');
    $this->db->where('tbjadwal.id_guru',$nip);
    $result = $this->db->limit(5,0)->get();
    return $result->result_array();
  }

  //tampil data rekapitulasi
  public function tampil_rekapitulasi($nip){
    $this->db->select('tbabsen.id_absen as id,tbabsen.waktu_absen as waktu,tbsiswa.nis as nis,tbsiswa.nama as nama, tbmapel.nama_mapel as matkul, tbkelas.nama_kelas as kelas');
    $this->db->from('tbabsen');          
    $this->db->join('tbjadwal','tbabsen.id_jadwal = tbjadwal.id_jadwal');    
    $this->db->join('tbkelas','tbkelas.id_kelas = tbjadwal.id_kelas');  
    $this->db->join('tbmapel','tbmapel.id_mapel = tbjadwal.id_mapel');
    $this->db->join('tbsiswa','tbsiswa.id_siswa = tbabsen.id_siswa'); 
    $this->db->where('tbjadwal.id_guru',$nip);
    $result = $this->db->get();
    return $result->result_array();
  }

  public function info_kelas($nip){
    $this->db->select('tbjadwal.id_kelas as id,tbkelas.nama_kelas as kelas');
    $this->db->from('tbjadwal');
    $this->db->join('tbkelas','tbkelas.id_kelas = tbjadwal.id_kelas');  
    $this->db->join('tbmapel','tbmapel.id_mapel = tbjadwal.id_mapel');
    $this->db->where('tbjadwal.id_guru',$nip);
    $result = $this->db->get();
    return $result->result_array();
  }

   public function cetak_rekapitulasi($kelas){
    if( empty($kelas)){
      return $this->empty_response();
    }else{
    $this->db->select('tbabsen.id_absen as id,tbabsen.waktu_absen as waktu,tbsiswa.nis as nis,tbsiswa.nama as nama, tbmapel.nama_mapel as matkul, tbkelas.nama_kelas as kelas');
    $this->db->from('tbabsen');          
    $this->db->join('tbjadwal','tbabsen.id_jadwal = tbjadwal.id_jadwal');    
    $this->db->join('tbkelas','tbkelas.id_kelas = tbjadwal.id_kelas');  
    $this->db->join('tbmapel','tbmapel.id_mapel = tbjadwal.id_mapel');
    $this->db->join('tbsiswa','tbsiswa.id_siswa = tbabsen.id_siswa'); 
    $this->db->where('tbjadwal.id_kelas',$kelas);
    $this->db->where('tbjadwal.id_guru',$this->session->id_guru);
    $result = $this->db->get();
    return $result->result_array();
    }
  }
}

?>
