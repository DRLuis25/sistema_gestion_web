<?php

namespace App\Models;

use App\Traits\Auditable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Process
 * @package App\Models
 * @version August 9, 2021, 3:35 am -05
 *
 * @property \App\Models\ProcessMap $processMap
 * @property \Illuminate\Database\Eloquent\Collection $hojaCaracterizacionProcesos
 * @property \Illuminate\Database\Eloquent\Collection $processFlowDiagrams
 * @property \Illuminate\Database\Eloquent\Collection $processTypes
 * @property \Illuminate\Database\Eloquent\Collection $seguimientos
 * @property \Illuminate\Database\Eloquent\Collection $seguimientoPropuestos
 * @property integer $process_map_id
 * @property string $name
 * @property string $description
 * @property integer $parent_process_id
 * @property boolean $status
 */
class Process extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'process';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'process_map_id',
        'name',
        'description',
        'unidad',
        'parent_process_id',
        'status'
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
        'description' => 'string',
        'unidad' => 'string',
        'parent_process_id' => 'integer',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'process_map_id' => 'required',
        'name' => 'required|string|max:255|min:3',
        'description' => 'required|string|max:255|min:3',
        'unidad' => 'required|string|max:255',
        'parent_process_id' => 'nullable',
        'status' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];
    public static $updateRules = [
        'process_map_id' => 'nullable',
        'name' => 'required|string|max:255|min:3',
        'description' => 'required|string|max:255|min:3',
        'parent_process_id' => 'nullable',
        'status' => 'nullable',
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
    public function hojaCaracterizacionProcesos()
    {
        return $this->hasMany(\App\Models\HojaCaracterizacionProcesos::class, 'process_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function processFlowDiagrams()
    {
        return $this->hasMany(\App\Models\ProcessFlowDiagram::class, 'process_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function processTypes()
    {
        return $this->hasMany(\App\Models\ProcessType::class, 'process_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function seguimientos()
    {
        return $this->hasMany(\App\Models\Seguimiento::class, 'process_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function seguimientoPropuestos()
    {
        return $this->hasMany(\App\Models\SeguimientoPropuesto::class, 'process_id');
    }
}
