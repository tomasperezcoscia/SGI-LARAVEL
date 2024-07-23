<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class Insumo
 *
 * @property $id
 * @property $nombre
 * @property $tipo
 * @property $precio
 * @property $inventario
 * @property $proovedor_id
 * @property $created_at
 * @property $updated_at
 *
 * @property InsumosParaObra[] $insumosParaObras
 * @property Proovedore $proovedore
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Insumo extends Model
{
    
    static $rules = [
        'fecha' => 'required',
		'nombre' => 'required',
		'tipo' => 'required',
		'precio' => 'required',
        'proovedor_id' => 'required',
        'orden_de_compra_id' => 'required',
        'factura' => 'required'
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */    protected $fillable = ['fecha','nombre','tipo','precio','proovedor_id','orden_de_compra_id', 'factura'];

    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proovedore()
    {
        return $this->hasOne('App\Models\Proovedore', 'id', 'proovedor_id');
    }
    public function ordenDeCompra()
    {
        return $this->hasOne('App\Models\Proovedore', 'id', 'orden_de_compra_id');
    }
    
    public function getFormattedMonthYearAttribute()
{
    return Carbon::parse($this->fecha)->format('m/y');
}

public function getFormattedDayMonthYearAttribute()
{
    return Carbon::parse($this->fecha)->format('d/m/Y');
}

}
