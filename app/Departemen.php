<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $table        =   "departemen";
    protected $primaryKey   =   "id_dpt";
    public $incrementing    =   false;
}
