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
 * @property $tipo
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
        'tipo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['legajo', 'nombre', 'numeroDeTelefono', 'tipo'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function insumos()
    {
        return $this->hasMany('App\Models\Insumo', 'proovedor_id', 'id');
    }
}
