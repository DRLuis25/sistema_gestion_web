<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Criterio
 * @package App\Models
 * @version August 1, 2021, 2:08 pm -05
 *
 * @property \App\Models\ProcessMap $processMap
 * @property \Illuminate\Database\Eloquent\Collection $processCriterios
 * @property integer $process_map_id
 * @property string $name
 * @property string $peso
 */
class Criterio extends Model
{
    //use SoftDeletes;

    public $table = 'criterios';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'process_map_id',
        'name',
        'peso',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'process_map_id' => 'integer',
        'name' => 'string',
        'peso' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'process_map_id' => 'required',
        'name' => 'required|string|max:255',
        'peso' => 'required|numeric|max:255',
        'description' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function processMap()
    {
        return $this->belongsTo(\App\Models\ProcessMap::class, 'process_map_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function processCriterios()
    {
        return $this->hasMany(\App\Models\ProcessCriterio::class, 'criterio_id');
    }
}
