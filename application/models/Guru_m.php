<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guru_m extends CI_Model {
    
    public function getGuru(){
        $this->db->order_by('nip', 'ASC'); // Untuk menambahkan Where Clause : username='$username'
        $result = $this->db->get('tbguru')->result(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }

    function insert($data)
    {
      $this->db->trans_start();
      $query = $this->db->insert("tbguru", $data);
      $this->db->trans_complete();
      if($query) {
        return true;
      }else{
        return false;
      }
    }

    function getGuruProfile($id){
        $this->db->where('nip',$id);
        $result = $this->db->get('tbguru')->row(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }

    public function update($data, $id)
    {
      $this->db->trans_start();
      $this->db->where('nip', $id);
     $query =  $this->db->update("tbguru", $data);
      $this->db->trans_complete();

      if($query) {
        return true;
      }else{
        return false;
      }
    }

    function hapus($id) {
        $this->db->where('nip',$id);
        $query = $this->db->delete('tbguru');
        if($query) {
            return true;
          }else{
            return false;
          }
    }
}