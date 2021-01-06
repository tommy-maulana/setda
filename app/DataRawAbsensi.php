<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataRawAbsensi extends Model
{
    protected $table        =   "data_raw_absensi";
    protected $primaryKey   =   "id_kry";
    //protected $fillable     =   "id_kry";
    protected $fillable = ['id_kry','tgl','kd_absen','id_absen'];
    public $timestamps      =   false;
}
