<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiUnitImagesModel extends Model
{
    protected $table = "unit_image";

    public function data_unit()
    {
        $query = $this->table($this->table)
                ->countAll();

        if($query > 0){
            $hasil = $this->table($this->table)
                ->select('*')
                ->get()->getRowArray();
        } else {
            $hasil = array(); 
        }
        return $hasil;
    }

    public function data_unit_byID($id_unit)
    {
        $query = $this->table($this->table)
                ->where('id_unit', $id_unit)
                ->countAll();

        if($query > 0){
            $hasil = $this->table($this->table)
                ->select('*')
                ->where('id_unit', $id_unit)
                ->get()->getRowArray();
        } else {
            $hasil = array(); 
        }
        return $hasil;
    }

}