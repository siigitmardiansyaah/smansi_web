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
    $this->db->select("b.id_mapel,d.nama_mapel,c.nama_guru,e.nama_kelas, DATE_FORMAT(b.waktu, '%W, %H:%i') as waktu");
    $this->db->join('tbjadwal b','a.id_jadwal_guru = b. id_jadwal');
    $this->db->join('tbguru c','b.id_guru = c.id_guru');
    $this->db->join('tbmapel d','b.id_mapel = d.id_mapel');
    $this->db->join('tbkelas e','b.id_kelas = e.id_kelas');
    $this->db->where('a.id_siswa',$id_siswa);
    $all = $this->db->get("tbjadwal_siswa a")->result();
    if($all) {
      $response['status']=200;
      $response['error']=false;
      $response['matkul']=$all;
      return $response;
    }else{
      $response['status']=502;
      $response['error']=true;
      $response['message']= $all;
      return $response;
    }

  }

}

?>