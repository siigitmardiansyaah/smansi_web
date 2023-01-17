<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siswa_m extends CI_Model {
    
    public function getGuru(){
        $this->db->select('a.*,b.*');
        $this->db->join('tbkelas b','a.id_kelas = b.id_kelas');
        $this->db->order_by('a.nis', 'ASC'); // Untuk menambahkan Where Clause : username='$username'
        $result = $this->db->get('tbsiswa a')->result(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }

    function insert($data)
    {
      $this->db->trans_start();
      $query = $this->db->insert("tbsiswa", $data);
      $this->db->trans_complete();
      if($query) {
        return true;
      }else{
        return false;
      }
    }

    function getGuruProfile($id){
        $this->db->where('id_siswa',$id);
        $result = $this->db->get('tbsiswa')->row(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }

    public function update($data, $id)
    {
      $this->db->trans_start();
      $this->db->where('id_siswa', $id);
     $query =  $this->db->update("tbsiswa", $data);
      $this->db->trans_complete();

      if($query) {
        return true;
      }else{
        return false;
      }
    }

    function hapus($id) {
        $this->db->where('id_siswa',$id);
        $query = $this->db->delete('tbsiswa');
        if($query) {
            return true;
          }else{
            return false;
          }
    }
}