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
    public static $rules = [
        'legajo' => 'required',
        'nombre' => 'required',
        'numeroDeTelefono' => 'required',
        'tipo' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['legajo', 'nombre', 'numeroDeTelefono', 'tipo'];

    public function insumos()
    {
        return $this->hasMany('App\Models\Insumo', 'proovedor_id', 'id');
    }

    // Sobreescribir el método update
    public function update(array $attributes = [], array $options = [])
    {
        \Log::warning('Atributos para actualización:', $attributes);
        $result = parent::update($attributes, $options);
        \Log::warning('Resultado de la actualización en el modelo:', ['success' => $result]);

        return $result;
    }
}
