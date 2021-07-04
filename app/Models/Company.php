<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Company
 * @package App\Models
 * @version June 26, 2021, 7:58 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $businessUnits
 * @property \Illuminate\Database\Eloquent\Collection $customers
 * @property \Illuminate\Database\Eloquent\Collection $suppliers
 * @property \Illuminate\Database\Eloquent\Collection $users
 * @property string $ruc
 * @property string $name
 * @property string $description
 * @property string $phone
 * @property string $address
 */
class Company extends Model
{
    use SoftDeletes;

    public $table = 'companies';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'ruc',
        'name',
        'description',
        'phone',
        'address'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ruc' => 'string',
        'name' => 'string',
        'description' => 'string',
        'phone' => 'string',
        'address' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ruc' => 'required|string|max:11',
        'name' => 'required|string|max:60',
        'description' => 'nullable|string|max:100',
        'phone' => 'nullable|string|max:17',
        'address' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function businessUnits()
    {
        return $this->hasMany(\App\Models\BusinessUnit::class, 'company_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function customers()
    {
        return $this->hasMany(\App\Models\Customer::class, 'company_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function suppliers()
    {
        return $this->hasMany(\App\Models\Supplier::class, 'company_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'company_id');
    }
}
