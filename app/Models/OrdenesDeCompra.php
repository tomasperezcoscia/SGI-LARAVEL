<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrdenesDeCompra
 *
 * @property $id
 * @property $numeroOrdenInterna
 * @property $cliente_id
 * @property $numeroOrden
 * @property $descripcionTarea
 * @property $valorTarea
 *
 * @property Cliente $cliente
 * @property HorasPersonal[] $horasPersonals
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class OrdenesDeCompra extends Model
{
    static $rules = [
        'numeroOrdenInterna' => 'required',
        'cliente_id' => 'required',
        'numeroOrden' => 'required',
        'descripcionTarea' => 'required',
        'valorTarea' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['numeroOrdenInterna', 'cliente_id', 'numeroOrden', 'descripcionTarea', 'valorTarea'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function horasPersonals()
    {
        return $this->hasMany('App\Models\HorasPersonal', 'orden_de_compra_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function presupuestos()
    {
        return $this->hasMany('App\Models\Presupuesto', 'orden_de_compra_id', 'id');
    }
}
