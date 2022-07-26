<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_m extends CI_Model {

    public function empty_response(){
        $response['status']=502;
        $response['error']=true;
        $response['message']='Field tidak boleh kosong';
        return $response;
      }
    
 function login($nis,$password,$device) 
 {
    if(empty($nis) || empty($password))
    {
        return $this->empty_response();
    }else{
        $this->db->where('nis',$nis);
        $query = $this->db->get('tbsiswa')->row();
        if($password != $query->password)
        {
            $response['status']=502;
            $response['error']=true;
            $response['message']='Password Tidak Sama';
            return $response;
        }else if($device != $query->device_id)
        {
            $response['status']=502;
            $response['error']=true;
            $response['message']='Anda Login Di Device Yang Berbeda, Silahkan hubungi STAFF TU untuk memperbarui data Device';
            return $response;
        }else{
            $this->db->join("tbkelas b","a.id_kelas = b.id_kelas");
            $this->db->where('a.nis',$nis);
            $query1 = $this->db->get('tbsiswa a')->row();
            if($query1){
                $response['status']=200;
                $response['error']=false;
                $response['login']=[
                    'id_siswa' => $query1->id_siswa,
                    'nis' => $query1->nis,
                    'id_kelas' => $query1->id_kelas,
                    'nama' =>$query1->nama,
                    'nama_kelas' => $query1->nama_kelas
                ];
                return $response;
              }else{
                $response['status']=502;
                $response['error']=true;
                $response['message']='Data Siswa gagal ditampilkan.';
                return $response;
              }
            }
        }
    }

    function register($nis, $password, $device){
        if(empty($nis) || empty($password))
        {
            return $this->empty_response();
        } else {
            $this->db->where('nis',$nis);
            $query = $this->db->get('tbsiswa')->row();
            if($query->password == null && $query->device_id == null)
            {
                $data = array(
                    'password' => $password,
                    'device_id'  => $device,
                );
                $this->db->where('nis',$nis);
                $query1 = $this->db->update('tbsiswa', $data);
                if($query1)
                {
                    $response['status']=200;
                    $response['error']=false;
                    $response['message']="Anda Berhasil Register";
                    return $response;
                }else{
                    $response['status']=502;
                    $response['error']=true;
                    $response['message']="Anda Gagal Register";
                    return $response;
                }
            }else{
                $response['status']=502;
                $response['error']=true;
                $response['message']="Anda Telah Register Sebelumnya, Jika ingin Login berbeda device silahkan hubungi Staff TU terlebih dahulu";
                return $response;
            }
        }
    }
}