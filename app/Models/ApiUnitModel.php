<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiUnitModel extends Model{

    protected $table = "unit";

    public function data_unit()
    {
        $query = $this->table($this->table)
                ->countAll();

        if($query > 0){
            $hasil = $this->table($this->table)->get()->getRowArray();
        } else {
            $hasil = array(); 
        }
        return $hasil;
    }

    public function data_unit_byID($id)
    {
        $query = $this->table($this->table)
                ->select('unit.*,unit_image.file_path')
                ->join('unit_image', 'unit_image.id_unit = unit.id', 'left')
                ->where('unit.id', $id)
                ->countAll();

        if($query > 0){
            $hasil = $this->table($this->table)
                ->select('unit.*,unit_image.file_path')
                ->join('unit_image', 'unit_image.id_unit = unit.id', 'left')
                ->where('unit.id', $id)
                ->get()->getRowArray();
           
        } else {
            $hasil = array(); 
        }
        return $hasil;
    }


}