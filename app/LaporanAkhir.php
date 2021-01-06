<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanAkhir extends Model
{
    protected $table        =   "laporan_akhir";
    protected $primaryKey   =   "periode";
    public $timestamps    =   false;
    public $incrementing    =   false;
}
