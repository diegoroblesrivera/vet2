<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmPeluqueria extends Model
{
    protected $table = 'cm_peluqueria';
    protected $fillable = [
        'id',
        'tipo_corte',
        'tipo_bano',
        'notas',
        'created_by',
        'updated_at'
    ];
}