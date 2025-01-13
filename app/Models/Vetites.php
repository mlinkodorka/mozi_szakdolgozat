<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vetites extends Model
{
    protected $table='vetitesek';
    protected $primaryKey=['vetites_id'];
    protected $fillable=['film', 'terem', 'kezdes_ideje', 'publikus_e', 'jegy_ara', 'szabad_helyek_szama', 'foglalt_helyek_szama'];
}
