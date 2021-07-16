<?php

namespace App\Models;

use App\Traits\Auditable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class supplyChain
 * @package App\Models
 * @version June 27, 2021, 2:46 am UTC
 *
 * @property \App\Models\Company $company
 * @property \App\Models\BusinessUnit $businessUnit
 * @property \Illuminate\Database\Eloquent\Collection $levels
 * @property \Illuminate\Database\Eloquent\Collection $supplyChainCustomers
 * @property \Illuminate\Database\Eloquent\Collection $supplyChainSuppliers
 * @property integer $company_id
 * @property integer $business_unit_id
 * @property string $period
 * @property string|\Carbon\Carbon $launch
 * @property boolean $status
 */
class supplyChain extends Model
{
    use SoftDeletes;
    use Auditable;
    public $table = 'supply_chains';

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
        'status' => 'boolean'
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
        'status' => 'required|boolean',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function levels()
    {
        return $this->hasMany(\App\Models\Level::class, 'supply_chain_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function supplyChainCustomers()
    {
        return $this->hasMany(\App\Models\SupplyChainCustomer::class, 'supply_chain_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function supplyChainSuppliers()
    {
        return $this->hasMany(\App\Models\SupplyChainSupplier::class, 'supply_chain_id');
    }
}
