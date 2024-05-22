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
    protected $fillable = ['personal_id', 'orden_de_compra_id', 'cant_horas'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ordenDeCompra()
    {
        return $this->belongsTo('App\Models\OrdenesDeCompra', 'orden_de_compra_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personal()
    {
        return $this->belongsTo('App\Models\Personal', 'personal_id');
    }

}
