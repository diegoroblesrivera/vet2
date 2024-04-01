<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmExamenes extends Model
{   
    protected $table = 'cm_examenes';
    protected $fillable = [
        'id',
        'nombre_examen_list'
    ];
}