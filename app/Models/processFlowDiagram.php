<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class processFlowDiagram
 * @package App\Models
 * @version August 7, 2021, 2:18 pm -05
 *
 * @property \App\Models\Process $process
 * @property \App\Models\ProcessMap $processMap
 * @property integer $process_map_id
 * @property integer $process_id
 * @property string $data
 */
class processFlowDiagram extends Model
{
    use SoftDeletes;

    public $table = 'process_flow_diagram';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'process_map_id',
        'process_id',
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
        'process_id' => 'integer',
        'data' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'process_map_id' => 'required',
        'process_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'data' => 'required|string'
    ];

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
    public function processMap()
    {
        return $this->belongsTo(\App\Models\ProcessMap::class, 'process_map_id');
    }
}
