<?php

namespace App\Models;

use App\Traits\Auditable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class processMap
 * @package App\Models
 * @version July 28, 2021, 8:56 pm -05
 *
 * @property \App\Models\BusinessUnit $businessUnit
 * @property \App\Models\Company $company
 * @property \Illuminate\Database\Eloquent\Collection $processes
 * @property integer $company_id
 * @property integer $business_unit_id
 * @property string $period
 * @property string|\Carbon\Carbon $launch
 */
class processMap extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'process_maps';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'company_id',
        'business_unit_id',
        'period',
        'launch',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'company_id' => 'integer',
        'business_unit_id' => 'integer',
        'period' => 'string',
        'launch' => 'datetime',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'company_id' => 'required',
        'business_unit_id' => 'required',
        'period' => 'required|string|max:20',
        'launch' => 'required',
        'status' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];
    public static $updateRules = [
        'company_id' => 'required',
        'business_unit_id' => 'required',
        'period' => 'required|string|max:20',
        'launch' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function businessUnit()
    {
        return $this->belongsTo(\App\Models\BusinessUnit::class, 'business_unit_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class, 'company_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function processes()
    {
        return $this->hasMany(\App\Models\Process::class, 'process_map_id');
    }
}
