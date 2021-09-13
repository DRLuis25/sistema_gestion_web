<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Indicator
 * @package App\Models
 * @version September 13, 2021, 2:23 am -05
 *
 * @property \App\Models\Frequency $frecuency
 * @property \App\Models\MatrizPriorizado $matrizPriorizado
 * @property \App\Models\Process $process
 * @property \Illuminate\Database\Eloquent\Collection $dataFuentes
 * @property integer $matriz_priorizado_id
 * @property integer $process_id
 * @property integer $frecuency_id
 * @property string $descripcion
 * @property string $formula
 * @property string $linea_base
 * @property string $objetivo
 * @property string $responsable
 * @property string $meta
 * @property string $iniciativas
 * @property integer $rojo
 * @property integer $verde
 */
class Indicator extends Model
{
    use SoftDeletes;

    public $table = 'indicators';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'matriz_priorizado_id',
        'process_id',
        'frecuency_id',
        'descripcion',
        'formula',
        'linea_base',
        'objetivo',
        'responsable',
        'meta',
        'iniciativas',
        'rojo',
        'verde'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'matriz_priorizado_id' => 'integer',
        'process_id' => 'integer',
        'frecuency_id' => 'integer',
        'descripcion' => 'string',
        'formula' => 'string',
        'linea_base' => 'string',
        'objetivo' => 'string',
        'responsable' => 'string',
        'meta' => 'string',
        'iniciativas' => 'string',
        'rojo' => 'integer',
        'verde' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'matriz_priorizado_id' => 'required',
        'process_id' => 'required',
        'frecuency_id' => 'required',
        'descripcion' => 'required|string|max:255',
        'formula' => 'required|string',
        'linea_base' => 'required|string',
        'objetivo' => 'required|string|max:255',
        'responsable' => 'required|string|max:255',
        'meta' => 'required|string|max:255',
        'iniciativas' => 'required|string',
        'rojo' => 'required|integer',
        'verde' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function frecuency()
    {
        return $this->belongsTo(\App\Models\Frequency::class, 'frecuency_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function matrizPriorizado()
    {
        return $this->belongsTo(\App\Models\MatrizPriorizado::class, 'matriz_priorizado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function process()
    {
        return $this->belongsTo(\App\Models\Process::class, 'process_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function dataFuentes()
    {
        return $this->hasMany(\App\Models\DataFuente::class, 'indicator_id');
    }
}
