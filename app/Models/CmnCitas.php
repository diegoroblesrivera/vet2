<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmnCitas extends Model
{
    protected $table = 'cmn_citas';

    protected $fillable = ['id_cliente',
    'id_pet',
    'peso',
    'vive_otros',
    'vive_otrosn',
    'tipo_alim',
    'tipo_alim_marca',
    'depo',
    'razon',
    'obs'];
}
