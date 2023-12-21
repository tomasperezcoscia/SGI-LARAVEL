<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AusenciasPersonal
 *
 * @property $id
 * @property $tipo
 * @property $descripcion
 * @property $fechaDeInicio
 * @property $fechaDeFin
 * @property $personal_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Personal $personal
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AusenciasPersonal extends Model
{
    
    static $rules = [
		'tipo' => 'required',
		'fechaDeInicio' => 'required',
		'personal_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo','descripcion','fechaDeInicio','fechaDeFin','personal_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function personal()
    {
        return $this->hasOne('App\Models\Personal', 'id', 'personal_id');
    }
    

}
