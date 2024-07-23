<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GastosBancarios extends Model
{
    static $rules = [
		'fecha' => 'required',
		'precio' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['fecha','precio'];
}
