<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmCirugia extends Model
{   
    protected $table = 'cm_cirugia';
    protected $fillable = [
        'id',
        'nombre_cirugia',
        'eval_anestesica',
        'eval_asa',  
        'notas',
        'created_by',
        'updated_at'
    ];
}