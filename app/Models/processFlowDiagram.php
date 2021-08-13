<?php

namespace App\Models;

use App\Traits\Auditable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class processFlowDiagram
 * @package App\Models
 * @version August 11, 2021, 2:45 pm -05
 *
 * @property \App\Models\MatrizPriorizado $matrizPriorizado
 * @property \App\Models\Process $process
 * @property \App\Models\ProcessMap $processMap
 * @property integer $process_map_id
 * @property integer $process_id
 * @property integer $matriz_priorizado_id
 * @property string $data
 * @property string $file
 * @property boolean $adjunto
 * @property boolean $redesing_boolean
 * @property string $redesign_data
 * @property string $redesign_file
 * @property boolean $redesing_adjunto
 */
class processFlowDiagram extends Model
{
    use Auditable;

    public $table = 'process_flow_diagram';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'process_map_id',
        'process_id',
        'matriz_priorizado_id',
        'data',
        'file',
        'adjunto',
        'redesing_boolean',
        'redesign_data',
        'redesign_file',
        'redesing_adjunto'
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
        'matriz_priorizado_id' => 'integer',
        'data' => 'string',
        'file' => 'string',
        'adjunto' => 'boolean',
        'redesing_boolean' => 'boolean',
        'redesign_data' => 'string',
        'redesign_file' => 'string',
        'redesing_adjunto' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'process_map_id' => 'required',
        'process_id' => 'required',
        'matriz_priorizado_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'data' => 'nullable|string',
        'file' => 'nullable|string',
        'adjunto' => 'required|boolean',
        'redesing_boolean' => 'nullable|boolean',
        'redesign_data' => 'nullable|string',
        'redesign_file' => 'nullable|string',
        'redesing_adjunto' => 'nullable|boolean'
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
    public function processMap()
    {
        return $this->belongsTo(\App\Models\ProcessMap::class, 'process_map_id');
    }
}
