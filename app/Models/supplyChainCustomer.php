<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class supplyChainCustomer
 * @package App\Models
 * @version June 27, 2021, 4:00 am UTC
 *
 * @property \App\Models\Customer $customer
 * @property \App\Models\Level $level
 * @property \App\Models\Customer $parentCustomer
 * @property \App\Models\SupplyChain $supplyChain
 * @property integer $supply_chain_id
 * @property integer $customer_id
 * @property integer $parent_customer_id
 * @property integer $level
 */
class supplyChainCustomer extends Model
{

    public $table = 'supply_chain_customers';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'supply_chain_id',
        'customer_id',
        'parent_customer_id',
        'level'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'supply_chain_id' => 'integer',
        'customer_id' => 'integer',
        'parent_customer_id' => 'integer',
        'level' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'supply_chain_id' => 'required',
        'customer_id' => 'required',
        'parent_customer_id' => 'nullable',
        'level' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function parentCustomer()
    {
        return $this->belongsTo(\App\Models\Customer::class, 'parent_customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function supplyChain()
    {
        return $this->belongsTo(\App\Models\SupplyChain::class, 'supply_chain_id');
    }
}
