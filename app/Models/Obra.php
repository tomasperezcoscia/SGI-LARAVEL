<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    use HasFactory;

    protected $fillable = ['presupuesto_id'];

    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class);
    }

    public function insumos()
    {
        return $this->belongsToMany(Insumo::class, 'insumo_obra')->withPivot('cantidad');
    }
}
