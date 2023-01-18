<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelas_m extends CI_Model {
    
    public function getKelas(){
        $this->db->order_by('id_kelas', 'ASC'); // Untuk menambahkan Where Clause : username='$username'
        $result = $this->db->get('tbkelas')->result(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }

    function insert($data)
    {
      $this->db->trans_start();
      $query = $this->db->insert("tbkelas", $data);
      $this->db->trans_complete();
      if($query) {
        return true;
      }else{
        return false;
      }
    }

    function getGuruProfile($id){
        $this->db->where('id_kelas',$id);
        $result = $this->db->get('tbkelas')->row(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }

    public function update($data, $id)
    {
      $this->db->trans_start();
      $this->db->where('id_kelas', $id);
     $query =  $this->db->update("tbkelas", $data);
      $this->db->trans_complete();

      if($query) {
        return true;
      }else{
        return false;
      }
    }

    function hapus($id) {
        $this->db->where('id_kelas',$id);
        $query = $this->db->delete('tbkelas');
        if($query) {
            return true;
          }else{
            return false;
          }
    }
}