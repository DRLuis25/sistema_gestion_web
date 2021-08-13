<?php

namespace App\Models;

use App\Traits\Auditable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class hojaCaracterizacionProcesos
 * @package App\Models
 * @version August 11, 2021, 2:46 pm -05
 *
 * @property \App\Models\MatrizPriorizado $matrizPriorizado
 * @property \App\Models\Process $process
 * @property \App\Models\ProcessMap $processMap
 * @property integer $process_map_id
 * @property integer $process_id
 * @property integer $matriz_priorizado_id
 * @property string $propietario
 * @property string $mision
 * @property string $empieza
 * @property string $incluye
 * @property string $termina
 * @property string $entradas_data
 * @property string $proveedores_data
 * @property string $salidas_data
 * @property string $clientes_data
 * @property string $inspecciones_data
 * @property string $registros_data
 * @property string $variables_control_data
 * @property string $indicadores_data
 * @property string $data
 * @property boolean $adjunto
 */
class hojaCaracterizacionProcesos extends Model
{
    use Auditable;
    public $table = 'hoja_caracterizacion_procesos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'process_map_id',
        'process_id',
        'matriz_priorizado_id',
        'propietario',
        'mision',
        'empieza',
        'incluye',
        'termina',
        'entradas_data',
        'proveedores_data',
        'salidas_data',
        'clientes_data',
        'inspecciones_data',
        'registros_data',
        'variables_control_data',
        'indicadores_data',
        'data',
        'adjunto'
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
        'propietario' => 'string',
        'mision' => 'string',
        'empieza' => 'string',
        'incluye' => 'string',
        'termina' => 'string',
        'entradas_data' => 'string',
        'proveedores_data' => 'string',
        'salidas_data' => 'string',
        'clientes_data' => 'string',
        'inspecciones_data' => 'string',
        'registros_data' => 'string',
        'variables_control_data' => 'string',
        'indicadores_data' => 'string',
        'data' => 'string',
        'adjunto' => 'boolean'
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
        'propietario' => 'nullable|string|max:255',
        'mision' => 'nullable|string|max:255',
        'empieza' => 'nullable|string|max:255',
        'incluye' => 'nullable|string|max:255',
        'termina' => 'nullable|string|max:255',
        'entradas_data' => 'nullable|string',
        'proveedores_data' => 'nullable|string',
        'salidas_data' => 'nullable|string',
        'clientes_data' => 'nullable|string',
        'inspecciones_data' => 'nullable|string',
        'registros_data' => 'nullable|string',
        'variables_control_data' => 'nullable|string',
        'indicadores_data' => 'nullable|string',
        'data' => 'nullable|string',
        'adjunto' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
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
