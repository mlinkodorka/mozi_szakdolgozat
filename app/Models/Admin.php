<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory; 
    protected $table='admin';
    protected $primaryKey='admin_id';
    protected $fillable = [
        'felhasznalonev', 'jelszo_hash', 'teljes_nev', 'szuletesi_datum', 'email', 'telefonszam', 'role'
    ];
    protected $hidden=['jelszo_hash'];

    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }
}
