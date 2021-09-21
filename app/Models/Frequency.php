<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Frequency
 * @package App\Models
 * @version September 21, 2021, 2:02 pm -05
 *
 * @property \Illuminate\Database\Eloquent\Collection $indicators
 * @property string $descripcion
 */
class Frequency extends Model
{
    use SoftDeletes;

    public $table = 'frequencies';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcion' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function indicators()
    {
        return $this->hasMany(\App\Models\Indicator::class, 'frecuency_id');
    }
}
