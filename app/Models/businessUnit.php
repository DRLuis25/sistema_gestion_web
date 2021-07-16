<?php

namespace App\Models;

use App\Traits\Auditable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class businessUnit
 * @package App\Models
 * @version June 27, 2021, 2:07 am UTC
 *
 * @property \App\Models\Company $company
 * @property \Illuminate\Database\Eloquent\Collection $historials
 * @property \Illuminate\Database\Eloquent\Collection $supplyChains
 * @property integer $company_id
 * @property string $name
 * @property string $description
 */
class businessUnit extends Model
{
    use SoftDeletes;
    use Auditable;
    public $table = 'business_units';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'company_id',
        'name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'company_id' => 'integer',
        'name' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'company_id' => 'required',
        'name' => 'required|string|max:60',
        'description' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

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
    public function historials()
    {
        return $this->hasMany(\App\Models\Historial::class, 'business_unit_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function supplyChains()
    {
        return $this->hasMany(supplyChain::class, 'business_unit_id');
    }
}
