<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foglalas_fizetes extends Model
{   
    use HasFactory;
    protected $table='foglalasok_fizetesek';
    protected $primaryKey='foglalas_fizetes_id';
    protected $fillable=['vetites', 'lefoglalt_jegyek_szama','vasarlo_foglalt_e', 'vasarlo_email', 'lejar', 'fizetve_van_e', 'kifizetes_ideje'];
}
