<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terem extends Model
{
    protected $table='termek';
    protected $primaryKey=['terem_id'];
    protected $fillable=['teremnev', 'kapacitas'];
}
