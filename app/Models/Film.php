<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table='filmek';
    public $incrementing=false;
    protected $primaryKey=['film_cime','megjelenes_eve'];
    protected $fillable=['film_cime', 'megjelenes_eve', 'szinkronos_e', 'hagyomanyos_e', 'film_nyelve', 'film_hossza'];
}
