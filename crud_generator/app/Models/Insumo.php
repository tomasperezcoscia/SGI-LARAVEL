<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Insumo
 *
 * @property $id
 * @property $nombre
 * @property $tipo
 * @property $precio
 * @property $inventario
 * @property $ultimaFechaPrecio
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
		'nombre' => 'required',
		'tipo' => 'required',
		'precio' => 'required',
		'inventario' => 'required',
		'ultimaFechaPrecio' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','tipo','precio','inventario','ultimaFechaPrecio','proovedor_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function insumosParaObras()
    {
        return $this->hasMany('App\Models\InsumosParaObra', 'id_insumo', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proovedore()
    {
        return $this->hasOne('App\Models\Proovedore', 'id', 'proovedor_id');
    }
    

}
