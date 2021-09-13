<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Objective
 * @package App\Models
 * @version September 13, 2021, 12:27 am -05
 *
 * @property \App\Models\MatrizPriorizado $matrizPriorizado
 * @property \App\Models\ObjectivesCompany $objectivesCompany
 * @property \App\Models\Perspective $perspective
 * @property \App\Models\Process $process
 * @property integer $matriz_priorizado_id
 * @property integer $process_id
 * @property integer $perspective_id
 * @property integer $objectives_company_id
 * @property string $descripcion
 * @property boolean $nuevo
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
        'objectives_company_id',
        'descripcion',
        'nuevo',
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
        'objectives_company_id' => 'integer',
        'descripcion' => 'string',
        'nuevo' => 'boolean',
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
        'objectives_company_id' => 'nullable',
        'descripcion' => 'nullable|string|max:255',
        'nuevo' => 'required|boolean',
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
    public function objectivesCompany()
    {
        return $this->belongsTo(\App\Models\ObjectivesCompany::class, 'objectives_company_id');
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
