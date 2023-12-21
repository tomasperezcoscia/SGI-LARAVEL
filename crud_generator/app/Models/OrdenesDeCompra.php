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
 * @property $cuit_cuil
 * @property $fechaDeIngreso
 * @property $caracter
 * @property $polizaArt
 * @property $vencimientoPolizaArt
 * @property $polizaDeAccPer
 * @property $vencimientoPolizaDeAccPer
 * @property $created_at
 * @property $updated_at
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
		'cuit_cuil' => 'required',
		'fechaDeIngreso' => 'required',
		'caracter' => 'required',
		'polizaArt' => 'required',
		'vencimientoPolizaArt' => 'required',
		'polizaDeAccPer' => 'required',
		'vencimientoPolizaDeAccPer' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['numeroOrdenInterna','cliente_id','numeroOrden','descripcionTarea','cuit_cuil','fechaDeIngreso','caracter','polizaArt','vencimientoPolizaArt','polizaDeAccPer','vencimientoPolizaDeAccPer'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'cliente_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function horasPersonals()
    {
        return $this->hasMany('App\Models\HorasPersonal', 'orden_de_compra_id', 'id');
    }
    

}
