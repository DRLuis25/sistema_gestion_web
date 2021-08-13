<?php

namespace App\Models;

use App\Traits\Auditable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Rol
 * @package App\Models
 * @version August 11, 2021, 5:30 pm -05
 *
 * @property \App\Models\ProcessMap $processMap
 * @property \Illuminate\Database\Eloquent\Collection $seguimientos
 * @property \Illuminate\Database\Eloquent\Collection $seguimientoPropuestos
 * @property integer $process_map_id
 * @property string $name
 */
class Rol extends Model
{
    use Auditable;
    public $table = 'rol';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'process_map_id',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'process_map_id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'process_map_id' => 'required',
        'name' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
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
    public function seguimientos()
    {
        return $this->hasMany(\App\Models\Seguimiento::class, 'rol_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function seguimientoPropuestos()
    {
        return $this->hasMany(\App\Models\SeguimientoPropuesto::class, 'rol_id');
    }
}
