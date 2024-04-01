<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmnPet extends Model
{
    protected $fillable = [
        'id',
        'id_dueno',
        'nombre',
        'especie',  
        'sexo',
        'created_by',
        'raza',
        'estado_repro',
        'pet_birth_date',
        'imagen_pet',
        'micro_num'
    ];
    // Dentro de la clase CmnPet

public function owner() {
    return $this->belongsTo(CmnCustomer::class, 'id_dueno', 'id');
}
}
