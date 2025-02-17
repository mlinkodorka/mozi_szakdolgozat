<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $table='filmek';
    public $incrementing=false;
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('film_cime', '=', $this->getAttribute('film_cime'))
            ->where('film_evszam', '=', $this->getAttribute('film_evszam'));
 
        return $query;
    }
    protected $fillable=['film_cime', 'film_evszam', 'szinkronos-e', 'hagyományos-e', 'film_nyelve', 'film_hossza'];
}
