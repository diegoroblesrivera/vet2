<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmFiles extends Model
{
    protected $table = 'cm_files';
    protected $fillable = [
        'id',
        'url',
        'concepto',
        'id_pet'
    ];


// public function pets() {
//     return $this->hasMany(CmnPet::class, 'id_dueno', 'id');
// }

}
