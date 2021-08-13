<?php

namespace App\Models;

use App\Traits\Auditable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Seguimiento
 * @package App\Models
 * @version August 11, 2021, 2:44 pm -05
 *
 * @property \App\Models\MatrizPriorizado $matrizPriorizado
 * @property \App\Models\Process $process
 * @property \App\Models\Rol $rol
 * @property integer $process_id
 * @property integer $rol_id
 * @property integer $matriz_priorizado_id
 * @property string $activity
 * @property integer $flow_id
 * @property number $time
 */
class Seguimiento extends Model
{
    use Auditable;
    public $table = 'seguimiento';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'process_id',
        'rol_id',
        'matriz_priorizado_id',
        'activity',
        'flow_id',
        'time'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'process_id' => 'integer',
        'rol_id' => 'integer',
        'matriz_priorizado_id' => 'integer',
        'activity' => 'string',
        'flow_id' => 'integer',
        'time' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'process_id' => 'required',
        'rol_id' => 'required',
        'matriz_priorizado_id' => 'required',
        'activity' => 'required|string|max:255',
        'flow_id' => 'required|integer',
        'time' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function rol()
    {
        return $this->belongsTo(\App\Models\Rol::class, 'rol_id');
    }
}
