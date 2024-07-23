<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class HorasPersonal
 *
 * @property $id
 * @property $cliente_id
 * @property $personal_id
 * @property $orden_de_compra_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property OrdenesDeCompra $ordenesDeCompra
 * @property Personal $personal
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class HorasPersonal extends Model
{
    static $rules = [
        'fecha' => 'required',
        'personal_id' => 'required',
        'orden_de_compra_id' => 'required',
        'cant_horas' => 'required'
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha','personal_id', 'orden_de_compra_id', 'cant_horas', 'precio_hora_a_fecha_de_carga'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ordenDeCompra()
    {
        return $this->belongsTo(OrdenesDeCompra::class, 'orden_de_compra_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personal()
    {
        return $this->belongsTo(Personal::class, 'personal_id');
    }

    public function getPrecioHoraAttribute()
    {
        return $this->cant_horas * $this->precio_hora_a_fecha_de_carga;
    }

    public static function boot()
    {
        parent::boot();

        // Add event listener for creating event
        static::creating(function ($horasPersonal) {
            $personal = Personal::find($horasPersonal->personal_id);
            if ($personal) {
                $horasPersonal->precio_hora_a_fecha_de_carga = $personal->salario_hora;
            }
        });
    }
}
