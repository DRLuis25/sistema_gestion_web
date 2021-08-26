<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Indicator
 * @package App\Models
 * @version August 26, 2021, 12:59 pm -05
 *
 * @property \App\Models\Frequency $frecuency
 * @property \App\Models\Process $process
 * @property \Illuminate\Database\Eloquent\Collection $dataFuentes
 * @property integer $process_id
 * @property integer $frecuency_id
 * @property string $descripcion
 * @property string $objetivo
 * @property string $responsable
 * @property string $iniciativas
 * @property string $linea_base
 * @property string $meta
 * @property string $formula
 * @property integer $verde
 * @property integer $rojo
 */
class Indicator extends Model
{
    use SoftDeletes;

    public $table = 'indicators';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'process_id',
        'frecuency_id',
        'descripcion',
        'objetivo',
        'responsable',
        'iniciativas',
        'linea_base',
        'meta',
        'formula',
        'verde',
        'rojo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'process_id' => 'integer',
        'frecuency_id' => 'integer',
        'descripcion' => 'string',
        'objetivo' => 'string',
        'responsable' => 'string',
        'iniciativas' => 'string',
        'linea_base' => 'string',
        'meta' => 'string',
        'formula' => 'string',
        'verde' => 'integer',
        'rojo' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'process_id' => 'required',
        'frecuency_id' => 'required',
        'descripcion' => 'required|string|max:255',
        'objetivo' => 'required|string|max:255',
        'responsable' => 'required|string|max:255',
        'iniciativas' => 'required|string',
        'linea_base' => 'required|string',
        'meta' => 'required|string|max:255',
        'formula' => 'required|string',
        'verde' => 'required|integer',
        'rojo' => 'required|integer',
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
