<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal_m extends CI_Model {
    
    public function getGuru(){
        $this->db->select('a.*,b.*,c.*,d.*');
        $this->db->join('tbkelas b','a.id_kelas = b.id_kelas');
        $this->db->join('tbmapel c','a.id_mapel = c.id_mapel');
        $this->db->join('tbguru d','a.id_guru = d.id_guru');
        $this->db->order_by('a.id_jadwal', 'ASC'); // Untuk menambahkan Where Clause : username='$username'
        $result = $this->db->get('tbjadwal a')->result(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }

    public function getSiswa(){
        $this->db->select('a.*,b.*,c.*,d.*,e.*,f.*');
        $this->db->join('tbkelas b','a.id_kelas = b.id_kelas');
        $this->db->join('tbmapel c','a.id_mapel = c.id_mapel');
        $this->db->join('tbguru d','a.id_guru = d.id_guru');
        $this->db->join('tbjadwal_siswa e','a.id_jadwal = e.id_jadwal_guru');
        $this->db->join('tbsiswa f','e.id_siswa = f.id_siswa');
        $this->db->order_by('a.id_jadwal', 'ASC'); // Untuk menambahkan Where Clause : username='$username'
        $result = $this->db->get('tbjadwal a')->result(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }

    function insert($data)
    {
      $this->db->trans_start();
      $query = $this->db->insert("tbjadwal", $data);
      $this->db->trans_complete();
      if($query) {
        return true;
      }else{
        return false;
      }
    }
    function insert1($data)
    {
      $this->db->trans_start();
      $query = $this->db->insert("tbjadwal_siswa", $data);
      $this->db->trans_complete();
      if($query) {
        return true;
      }else{
        return false;
      }
    }

    function getGuruProfile($id){
        $this->db->where('id_jadwal',$id);
        $result = $this->db->get('tbjadwal')->row(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }
    function getGuruProfile1($id){
        $this->db->where('id_jadwalsiswa',$id);
        $result = $this->db->get('tbjadwal_siswa')->row(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }

    public function update($data, $id)
    {
      $this->db->trans_start();
      $this->db->where('id_jadwal', $id);
     $query =  $this->db->update("tbjadwal", $data);
      $this->db->trans_complete();

      if($query) {
        return true;
      }else{
        return false;
      }
    }

    function hapus($id) {
        $this->db->where('id_jadwal',$id);
        $query = $this->db->delete('tbjadwal');
        if($query) {
            return true;
          }else{
            return false;
          }
    }
    public function update1($data, $id)
    {
      $this->db->trans_start();
      $this->db->where('id_jadwalsiswa', $id);
     $query =  $this->db->update("tbjadwal_siswa", $data);
      $this->db->trans_complete();

      if($query) {
        return true;
      }else{
        return false;
      }
    }

    function hapus1($id) {
        $this->db->where('id_jadwalsiswa',$id);
        $query = $this->db->delete('tbjadwal_siswa');
        if($query) {
            return true;
          }else{
            return false;
          }
    }
}