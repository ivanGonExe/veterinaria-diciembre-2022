<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class articulo extends Model
{
  

    use HasFactory;

    public function categoria()
   {
     return $this->belongsTo(categoria::class);
   }

   public function lotes()
   {
    return $this->hasMany(loteDescripcion::class);
   } 

    //public function articuloAlertas()
    //{
      //  return $this->belongsTo(ArticuloAlerta::class);
    //}

}
