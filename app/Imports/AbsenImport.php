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
        return new DataRawAbsensi([
            'id_kry'        => $row[0],
            'tgl'           => $row[1],
            'kd_absen'      => $row[2],
            'id_mesin'      => $row[3]
        ]);
    }
}
