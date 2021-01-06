<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewKaryawan extends Model
{
    protected $table        =   "view_data_karyawan";
    protected $primaryKey   =   "id_kry";
    public $incrementing    =   false;
}
