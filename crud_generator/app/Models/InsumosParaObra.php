<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InsumosParaObra
 *
 * @property $id
 * @property $id_insumo
 * @property $id_obra
 * @property $cantidad
 * @property $created_at
 * @property $updated_at
 *
 * @property Insumo $insumo
 * @property Obra $obra
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class InsumosParaObra extends Model
{
    
    static $rules = [
		'id_insumo' => 'required',
		'id_obra' => 'required',
		'cantidad' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_insumo','id_obra','cantidad'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function insumo()
    {
        return $this->hasOne('App\Models\Insumo', 'id', 'id_insumo');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function obra()
    {
        return $this->hasOne('App\Models\Obra', 'id', 'id_obra');
    }
    

}
