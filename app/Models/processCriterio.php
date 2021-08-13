<?php

namespace App\Models;

use App\Traits\Auditable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class processCriterio
 * @package App\Models
 * @version August 1, 2021, 4:17 pm -05
 *
 * @property \App\Models\Criterio $criterio
 * @property \App\Models\Process $process
 * @property integer $process_id
 * @property integer $criterio_id
 */
class processCriterio extends Model
{
    use Auditable;

    public $table = 'process_criterio';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'process_map_id',
        'data',
        'process_id_data',
        'process_values_data'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'process_map_id' => 'integer',
        'data' => 'string',
        'process_id_data' => 'string',
        'process_values_data' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'process_id' => 'required',
        'data' => 'required',
        'process_id_data' => 'required',
        'process_values_data' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function criterio()
    {
        return $this->belongsTo(\App\Models\Criterio::class, 'criterio_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function process()
    {
        return $this->belongsTo(\App\Models\Process::class, 'process_id');
    }
    public static function findOrCreate($id)
    {
        $obj = static::where('process_map_id','=',$id);
        return $obj ?: new static;
    }
}
