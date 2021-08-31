<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Objective
 * @package App\Models
 * @version August 30, 2021, 5:53 pm -05
 *
 * @property \App\Models\MatrizPriorizado $matrizPriorizado
 * @property \App\Models\Perspective $perspective
 * @property \App\Models\Process $process
 * @property integer $matriz_priorizado_id
 * @property integer $process_id
 * @property integer $perspective_id
 * @property string $descripcion
 * @property string $efecto
 */
class Objective extends Model
{
    use SoftDeletes;

    public $table = 'objectives';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'matriz_priorizado_id',
        'process_id',
        'perspective_id',
        'descripcion',
        'efecto'
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
        'perspective_id' => 'integer',
        'descripcion' => 'string',
        'efecto' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'matriz_priorizado_id' => 'required',
        'process_id' => 'required',
        'perspective_id' => 'required',
        'descripcion' => 'required|string|max:255',
        'efecto' => 'nullable|string',
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
    public function perspective()
    {
        return $this->belongsTo(\App\Models\Perspective::class, 'perspective_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function process()
    {
        return $this->belongsTo(\App\Models\Process::class, 'process_id');
    }
}
