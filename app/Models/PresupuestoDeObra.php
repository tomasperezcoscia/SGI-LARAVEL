<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresupuestoDeObra extends Model
{
    use HasFactory;
    public function obra()
    {
        return $this->belongsTo(Obra::class, 'id_obra');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function insumosParaObra()
    {
        return $this->belongsTo(InsumosParaObra::class, 'id_insumosParaObra');
    }

    public function horasPersonal()
    {
        return $this->belongsTo(HorasPersonal::class, 'id_horasDePersonal');
    }
}
