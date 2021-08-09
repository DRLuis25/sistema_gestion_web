<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class historialProcessMap
 * @package App\Models
 * @version August 8, 2021, 9:17 pm -05
 *
 * @property \App\Models\ProcessMap $processMap
 * @property integer $process_map_id
 * @property string $description
 * @property string $data
 */
class historialProcessMap extends Model
{
    use SoftDeletes;

    public $table = 'historial_process_map';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'process_map_id',
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
        'process_map_id' => 'integer',
        'description' => 'string',
        'data' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'process_map_id' => 'required',
        'description' => 'nullable|string|max:80',
        'data' => 'required|string',
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
}
