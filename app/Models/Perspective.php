<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Perspective
 * @package App\Models
 * @version August 26, 2021, 1:01 pm -05
 *
 * @property \App\Models\Process $process
 * @property \Illuminate\Database\Eloquent\Collection $objectives
 * @property integer $process_id
 * @property string $descripcion
 */
class Perspective extends Model
{
    use SoftDeletes;

    public $table = 'perspectives';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'process_id',
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'process_id' => 'integer',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'process_id' => 'required',
        'descripcion' => 'required|string|max:255'
    ];

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
    public function objectives()
    {
        return $this->hasMany(\App\Models\Objective::class, 'perspective_id');
    }
}
