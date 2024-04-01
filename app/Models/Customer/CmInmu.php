<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmInmu extends Model
{
    protected $table = 'cm_inmu';
    protected $fillable = [
        'id',
        'nombre_vacuna',
        'n_serie',
        'cantidad',
        'unidad',
        'notas',
        'created_by',
        'updated_at'
    ];
}