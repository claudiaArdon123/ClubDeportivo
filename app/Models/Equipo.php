<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    /** @use HasFactory<\Database\Factories\EquipoFactory> */
    use HasFactory;

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function jugadores()
    {
        return $this->hasMany(Jugador::class);
    }
}
