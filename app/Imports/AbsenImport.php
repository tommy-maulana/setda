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
        $a = strptime($row[1], '%Y-%m-%d %H:%i');
        $timestamp = mktime(0, 0, 0, $a['tm_mon']+1, $a['tm_mday'], $a['tm_year']+1900);
        return new DataRawAbsensi([
            'id_kry'        => $row[0],
            'tgl'           => $timestamp,
            'kd_absen'      => $row[2],
            'id_mesin'      => $row[3]
        ]);
    }
}
