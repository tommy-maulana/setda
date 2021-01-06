<?php

namespace App\Imports;

use App\DataRawAbsensi;
use Maatwebsite\Excel\Concerns\ToModel;

class AbsenImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $str = str_replace('/','-',$row[1]);
        
        return new DataRawAbsensi([
            'id_kry'        => $row[0],
            'tgl'           => strtotime($str);,
            'kd_absen'      => $row[2],
            'id_mesin'      => $row[3]
        ]);
    }
}
