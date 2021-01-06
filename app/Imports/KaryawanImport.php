<?php

namespace App\Imports;

use App\Karyawan;
use Maatwebsite\Excel\Concerns\ToModel;

class KaryawanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Karyawan([
            'id_kry'        => $row[0],
            'nama_kry'      => $row[1],
            'id_dpt'        => $row[2],
            'id_jbt'        => $row[3],
            'status'        => '1'
        ]);
    }
}
