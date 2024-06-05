<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    use HasFactory;

    protected $fillable = ['orden_de_compra_id', 'estado', 'numero_legajo'];

    public function ordenDeCompra()
    {
        return $this->belongsTo(OrdenesDeCompra::class, 'orden_de_compra_id');
    }

    public function obra()
    {
        return $this->hasOne(Obra::class);
    }

    public function insumos()
    {
        return $this->belongsToMany(Insumo::class, 'insumo_presupuesto')->withPivot('cantidad');
    }

    public function getEstadoLegibleAttribute()
    {
        $estados = [
            'in_progress' => 'En progreso',
            'presupuestado' => 'Presupuestado',
            'en_espera_de_pago' => 'En espera de pago',
        ];

        return $estados[$this->estado] ?? $this->estado;
    }
}
