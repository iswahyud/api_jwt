<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiAuthmodel extends Model{

    protected $table = "user";

    //customer
    public function register_customer($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query ? true : false;
    }

    //customer
    public function cek_login_cust($username)
    {
        $query = $this->table($this->table)
                ->where('username', $username)
                ->countAll();

        if($query > 0){
            $hasil = $this->table($this->table)
                    ->where('username', $username)
                    ->limit(1)
                    ->get()
                    ->getRowArray();
        } else {
            $hasil = array(); 
        }
        return $hasil;
    }


}