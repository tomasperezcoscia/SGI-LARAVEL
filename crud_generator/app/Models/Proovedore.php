<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Proovedore
 *
 * @property $id
 * @property $legajo
 * @property $nombre
 * @property $numeroDeTelefono
 * @property $cuil
 * @property $tipo
 * @property $fechaAlta
 * @property $fechaBaja
 * @property $created_at
 * @property $updated_at
 *
 * @property Insumo[] $insumos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Proovedore extends Model
{
    
    static $rules = [
		'legajo' => 'required',
		'nombre' => 'required',
		'numeroDeTelefono' => 'required',
		'cuil' => 'required',
		'tipo' => 'required',
		'fechaAlta' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['legajo','nombre','numeroDeTelefono','cuil','tipo','fechaAlta','fechaBaja'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function insumos()
    {
        return $this->hasMany('App\Models\Insumo', 'proovedor_id', 'id');
    }
    

}
