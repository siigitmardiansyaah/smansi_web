<?php
// extends class Model
class MatkulM extends CI_Model{

  // response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong';
    return $response;
  }

  // mengambil semua data matkul
  public function all_matkul($id_siswa){
<<<<<<< HEAD
    $this->db->select("b.id_mapel,d.nama_mapel,c.nama_guru,e.nama_kelas, DATE_FORMAT(b.waktu, '%W, %H:%i') as waktu");
    $this->db->join('tbjadwal b','a.id_jadwal_guru = b. id_jadwal');
    $this->db->join('tbguru c','b.nip = c.nip');
    $this->db->join('tbmapel d','b.id_mapel = d.id_mapel');
    $this->db->join('tbkelas e','b.id_kelas = e.id_kelas');
    $this->db->where('id_siswa',$id_siswa);
=======
    $this->db->select("a.id_mapel,d.nama_mapel, c.nama_kelas, DATE_FORMAT(a.waktu, '%W,%H:%i') as waktu");
    $this->db->join('tbsiswa b','a.id_siswa = b. id_siswa');
    $this->db->join('tbkelas c','a.id_kelas = c.id_kelas');
    $this->db->join('tbmapel d','a.id_mapel = d.id_mapel');
>>>>>>> d1b8c56b57908e07ede54c3c7ccada25c9bcf72c
    $all = $this->db->get("tbjadwal_siswa a")->result();
    $response['status']=200;
    $response['error']=false;
    $response['matkul']=$all;
    return $response;
  }

}

?>