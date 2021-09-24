<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class dataFuente
 * @package App\Models
 * @version September 22, 2021, 12:06 am -05
 *
 * @property \App\Models\Indicator $indicator
 * @property integer $indicator_id
 * @property string|\Carbon\Carbon $fecha
 * @property integer $valor
 * @property string $estado
 */
class dataFuente extends Model
{

    public $table = 'data_fuente';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'indicator_id',
        'fecha',
        'valor',
        'estado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'indicator_id' => 'integer',
        'fecha' => 'datetime',
        'valor' => 'integer',
        'estado' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'indicator_id' => 'required',
        'fecha' => 'required',
        'valor' => 'required|integer',
        'estado' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function indicator()
    {
        return $this->belongsTo(\App\Models\Indicator::class, 'indicator_id');
    }
}
