<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historial_servicio extends Model
{
    use HasFactory;
    
    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    public function detalles()
    {
        return $this->hasMany(Detalle_servicio::class);
    }
}
