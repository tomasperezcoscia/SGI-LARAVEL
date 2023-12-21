<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Obra
 *
 * @property $id
 * @property $nombre
 * @property $legajo
 * @property $id_cliente
 * @property $id_insumosParaObra
 * @property $id_horasDePersonal
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property InsumosParaObra[] $insumosParaObras
 * @property PresupuestoDeObra[] $presupuestoDeObras
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Obra extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'legajo' => 'required',
		'id_cliente' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','legajo','id_cliente','id_insumosParaObra','id_horasDePersonal'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'id_cliente');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function insumosParaObras()
    {
        return $this->hasMany('App\Models\InsumosParaObra', 'id_obra', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function presupuestoDeObras()
    {
        return $this->hasMany('App\Models\PresupuestoDeObra', 'id_obra', 'id');
    }
    

}
