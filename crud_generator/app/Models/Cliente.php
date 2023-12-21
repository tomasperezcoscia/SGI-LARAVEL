<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 *
 * @property $id
 * @property $legajo
 * @property $nombre
 * @property $tipo
 * @property $created_at
 * @property $updated_at
 *
 * @property HorasPersonal[] $horasPersonals
 * @property Obra[] $obras
 * @property OrdenesDeCompra[] $ordenesDeCompras
 * @property PresupuestoDeObra[] $presupuestoDeObras
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cliente extends Model
{
    
    static $rules = [
		'legajo' => 'required',
		'nombre' => 'required',
		'tipo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['legajo','nombre','tipo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function horasPersonals()
    {
        return $this->hasMany('App\Models\HorasPersonal', 'cliente_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function obras()
    {
        return $this->hasMany('App\Models\Obra', 'id_cliente', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordenesDeCompras()
    {
        return $this->hasMany('App\Models\OrdenesDeCompra', 'cliente_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function presupuestoDeObras()
    {
        return $this->hasMany('App\Models\PresupuestoDeObra', 'id_cliente', 'id');
    }
    

}
