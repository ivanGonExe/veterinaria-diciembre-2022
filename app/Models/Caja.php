<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

public function ventas(){
    return $this->hasMany(venta::class);
}
public function usuario(){
    return $this->hasOne(User::class);
}

}