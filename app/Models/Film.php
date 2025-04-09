<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $table='filmek';
    protected $primaryKey='film_id';
    protected $fillable = [
        'film_cime', 'film_evszam', 'szinkronos-e', 'hagyományos-e',
        'film_nyelve', 'film_hossza', 'boritokep'
    ];

    public function vetitesek()
    {
        return $this->hasMany(Vetites::class, 'film', 'film_id');
    }
}
