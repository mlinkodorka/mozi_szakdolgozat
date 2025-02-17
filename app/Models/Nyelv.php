<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nyelv extends Model
{
    use HasFactory;  
    protected $table = 'nyelvek';
    protected $primaryKey = 'nyelvkod';
    
    public $incrementing = false;
    protected $fillable = ['nyelvkod', 'nyelv_nev'];
}

