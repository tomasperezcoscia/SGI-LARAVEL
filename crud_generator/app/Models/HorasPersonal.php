<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class HorasPersonal
 *
 * @property $id
 * @property $cliente_id
 * @property $personal_id
 * @property $orden_de_compra_id
 * @property $tarea_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property OrdenesDeCompra $ordenesDeCompra
 * @property Personal $personal
 * @property Tarea $tarea
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class HorasPersonal extends Model
{
    
    static $rules = [
		'cliente_id' => 'required',
		'personal_id' => 'required',
		'orden_de_compra_id' => 'required',
		'tarea_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cliente_id','personal_id','orden_de_compra_id','tarea_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'cliente_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ordenesDeCompra()
    {
        return $this->hasOne('App\Models\OrdenesDeCompra', 'id', 'orden_de_compra_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function personal()
    {
        return $this->hasOne('App\Models\Personal', 'id', 'personal_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tarea()
    {
        return $this->hasOne('App\Models\Tarea', 'id', 'tarea_id');
    }
    

}
