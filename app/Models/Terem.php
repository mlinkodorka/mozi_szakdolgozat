<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terem extends Model
{
    use HasFactory; 
    protected $table='termek';
    protected $primaryKey='terem_id';
    protected $fillable=['terem_nev', 'kapacitas'];
}
