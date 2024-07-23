<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargasSociales extends Model
{
    use HasFactory;

    static $rules = [
        'fecha' => 'required',
        'f931' => 'nullable|numeric',
        'uocra' => 'nullable|numeric',
        'intereses' => 'nullable|numeric',
        'ieric' => 'nullable|numeric',
        'fondoDesempleo' => 'nullable|numeric',
    ];

    protected $perPage = 20;

    protected $fillable = ['fecha', 'f931', 'uocra', 'intereses', 'ieric', 'fondoDesempleo'];
}
