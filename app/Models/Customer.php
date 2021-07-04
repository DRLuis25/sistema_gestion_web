<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Customer
 * @package App\Models
 * @version June 27, 2021, 1:46 am UTC
 *
 * @property \App\Models\Company $company
 * @property \Illuminate\Database\Eloquent\Collection $supplyChainCustomers
 * @property \Illuminate\Database\Eloquent\Collection $supplyChainCustomer1s
 * @property string $dni
 * @property string $name
 * @property string $last_name
 * @property string $contact
 * @property string $email
 * @property string $address
 * @property integer $company_id
 */
class Customer extends Model
{
    use SoftDeletes;

    public $table = 'customers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'dni',
        'name',
        'last_name',
        'contact',
        'email',
        'address',
        'company_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'dni' => 'string',
        'name' => 'string',
        'last_name' => 'string',
        'contact' => 'string',
        'email' => 'string',
        'address' => 'string',
        'company_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'dni' => 'required|string|max:8',
        'name' => 'required|string|max:100',
        'last_name' => 'required|string|max:100',
        'contact' => 'nullable|string|max:17',
        'email' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:100',
        'company_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
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
    public function supplyChainCustomers()
    {
        return $this->hasMany(\App\Models\SupplyChainCustomer::class, 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function supplyChainCustomer1s()
    {
        return $this->hasMany(\App\Models\SupplyChainCustomer::class, 'parent_customer_id');
    }
}
