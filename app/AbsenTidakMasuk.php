<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbsenTidakMasuk extends Model
{
    protected $table        =   "absen_tidak_masuk";
    protected $primaryKey   =   "id_kry";
    public $timestamps    =   false;
}
