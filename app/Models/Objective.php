<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Objective
 * @package App\Models
 * @version August 26, 2021, 1:01 pm -05
 *
 * @property \App\Models\Perspective $perspective
 * @property \App\Models\Process $process
 * @property \Illuminate\Database\Eloquent\Collection $objectiveObjectives
 * @property \Illuminate\Database\Eloquent\Collection $objectiveObjective1s
 * @property integer $process_id
 * @property integer $perspective_id
 * @property string $descripcion
 * @property integer $level
 */
class Objective extends Model
{
    use SoftDeletes;

    public $table = 'objectives';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'process_id',
        'perspective_id',
        'descripcion',
        'level'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'process_id' => 'integer',
        'perspective_id' => 'integer',
        'descripcion' => 'string',
        'level' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'process_id' => 'required',
        'perspective_id' => 'required',
        'descripcion' => 'required|string|max:255',
        'level' => 'required|integer|min:0',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function objectiveObjectives()
    {
        return $this->hasMany(\App\Models\ObjectiveObjective::class, 'objective_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function objectiveObjective1s()
    {
        return $this->hasMany(\App\Models\ObjectiveObjective::class, 'objective_id');
    }
}
