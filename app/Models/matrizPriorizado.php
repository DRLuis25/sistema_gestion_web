<?php

namespace App\Models;

use App\Traits\Auditable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class matrizPriorizado
 * @package App\Models
 * @version August 11, 2021, 3:59 pm -05
 *
 * @property \App\Models\ProcessCriterio $processCriterio
 * @property \App\Models\ProcessMap $processMap
 * @property \Illuminate\Database\Eloquent\Collection $hojaCaracterizacionProcesos
 * @property \Illuminate\Database\Eloquent\Collection $processFlowDiagrams
 * @property \Illuminate\Database\Eloquent\Collection $seguimientos
 * @property \Illuminate\Database\Eloquent\Collection $seguimientoPropuestos
 * @property integer $process_map_id
 * @property integer $process_criterio_id
 * @property string $description
 * @property string $process_id_data
 * @property string $process_id_data_flow_diagram
 * @property string $process_id_data_seguimiento
 * @property string $process_id_data_all
 * @property string $process_values_data
 */
class matrizPriorizado extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'matriz_priorizado';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'process_map_id',
        'process_criterio_id',
        'description',
        'process_id_data',
        'process_id_data_flow_diagram',
        'process_id_data_seguimiento',
        'process_id_data_all',
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
        'process_criterio_id' => 'integer',
        'description' => 'string',
        'process_id_data' => 'string',
        'process_id_data_flow_diagram' => 'string',
        'process_id_data_seguimiento' => 'string',
        'process_id_data_all' => 'string',
        'process_values_data' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'process_map_id' => 'required',
        'process_criterio_id' => 'required',
        'description' => 'nullable|string|max:255',
        'process_id_data' => 'required|string',
        'process_id_data_flow_diagram' => 'required|string',
        'process_id_data_seguimiento' => 'required|string',
        'process_id_data_all' => 'required|string',
        'process_values_data' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function processCriterio()
    {
        return $this->belongsTo(\App\Models\ProcessCriterio::class, 'process_criterio_id');
    }

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
    public function hojaCaracterizacionProcesos()
    {
        return $this->hasMany(\App\Models\HojaCaracterizacionProcesos::class, 'matriz_priorizado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function processFlowDiagrams()
    {
        return $this->hasMany(\App\Models\ProcessFlowDiagram::class, 'matriz_priorizado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function seguimientos()
    {
        return $this->hasMany(\App\Models\Seguimiento::class, 'matriz_priorizado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function seguimientoPropuestos()
    {
        return $this->hasMany(\App\Models\SeguimientoPropuesto::class, 'matriz_priorizado_id');
    }
}
