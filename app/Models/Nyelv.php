<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nyelv extends Model
{
    protected $table='nyelvek';
    protected $primaryKey=['nyelv_kodja'];
    public $incrementing=false;
    protected $fillable=['nyelv_neve'];
}
