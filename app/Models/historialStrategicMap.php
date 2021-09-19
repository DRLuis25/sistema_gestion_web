<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class historialStrategicMap
 * @package App\Models
 * @version September 19, 2021, 2:47 am -05
 *
 * @property \App\Models\MatrizPriorizado $matrizPriorizado
 * @property \App\Models\Process $process
 * @property integer $matriz_priorizado_id
 * @property integer $process_id
 * @property string $description
 * @property string $data
 */
class historialStrategicMap extends Model
{
    use SoftDeletes;

    public $table = 'historial_maps';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'matriz_priorizado_id',
        'process_id',
        'description',
        'data'
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
        'description' => 'string',
        'data' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'matriz_priorizado_id' => 'required',
        'process_id' => 'required',
        'description' => 'required|string|max:255',
        'data' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

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
}
