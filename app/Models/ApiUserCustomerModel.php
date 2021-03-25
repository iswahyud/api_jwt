<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiUserCustomerModel extends Model{

    protected $table = "user";
    
    public function data_customer($username)
    {
        $query = $this->table($this->table)
                ->where('username', $username)
                ->countAll();

        if($query > 0){
            $hasil = $this->table($this->table)
                ->select('*')
                ->where('username', $username)
                ->get()->getRowArray();
        } else {
            $hasil = array(); 
        }
        return $hasil;
    }

}