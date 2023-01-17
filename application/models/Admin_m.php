<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_m extends CI_Model {
    

    function countSiswa() {
        return $this->db->get('tbsiswa')->num_rows();
    }

    function countGuru() {
        return $this->db->get('tbguru')->num_rows();
    }

    function countMapel() {
        return $this->db->get('tbmapel')->num_rows();
    }

    function countKelas() {
        return $this->db->get('tbkelas')->num_rows();
    }
}