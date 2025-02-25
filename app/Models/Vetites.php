<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vetites extends Model
{
    use HasFactory; 
    protected $table='vetitesek';
    protected $primaryKey='vetites_id';
    protected $fillable=['film_cime', 'film_evszam','terem', 'kezdes_ideje', 'publikus_e', 'jegy_ara', 'szabad_helyek_szama', 'foglalt_helyek_szama'];
}
