<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmDespa extends Model
{   
    protected $table = 'cm_despa';
    protected $fillable = [
        'id',
        'nombre_despa',
        'dosis',
        'presentacion',  
        'dosis',
        'cantidad', 
        'unidad',
        'created_by',
        'updated_at'
    ];
}