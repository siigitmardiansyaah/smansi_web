<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapel_m extends CI_Model {
    
    public function getKelas(){
        $this->db->order_by('id_mapel', 'ASC'); // Untuk menambahkan Where Clause : username='$username'
        $result = $this->db->get('tbmapel')->result(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }

    function insert($data)
    {
      $this->db->trans_start();
      $query = $this->db->insert("tbmapel", $data);
      $this->db->trans_complete();
      if($query) {
        return true;
      }else{
        return false;
      }
    }

    function getGuruProfile($id){
        $this->db->where('id_mapel',$id);
        $result = $this->db->get('tb_kelas')->row(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }

    public function update($data, $id)
    {
      $this->db->trans_start();
      $this->db->where('id_mapel', $id);
     $query =  $this->db->update("tbmapel", $data);
      $this->db->trans_complete();

      if($query) {
        return true;
      }else{
        return false;
      }
    }

    function hapus($id) {
        $this->db->where('id_mapel',$id);
        $query = $this->db->delete('tbmapel');
        if($query) {
            return true;
          }else{
            return false;
          }
    }
}