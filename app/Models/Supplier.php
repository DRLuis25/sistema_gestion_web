<?php

namespace App\Models;

use App\Traits\Auditable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Supplier
 * @package App\Models
 * @version June 27, 2021, 1:22 am UTC
 *
 * @property \App\Models\Company $company
 * @property \Illuminate\Database\Eloquent\Collection $supplyChainSuppliers
 * @property \Illuminate\Database\Eloquent\Collection $supplyChainSupplier1s
 * @property string $ruc
 * @property string $name
 * @property string $contact_name
 * @property string $contact
 * @property string $email
 * @property string $address
 * @property integer $company_id
 */
class Supplier extends Model
{
    use SoftDeletes;
    use Auditable;
    public $table = 'suppliers';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'ruc',
        'name',
        'contact_name',
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
        'ruc' => 'string',
        'name' => 'string',
        'contact_name' => 'string',
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
        'ruc' => 'required|string|max:11',
        'name' => 'required|string|max:50',
        'contact_name' => 'nullable|string|max:50',
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
    public function supplyChainSuppliers()
    {
        return $this->hasMany(\App\Models\SupplyChainSupplier::class, 'parent_supplier_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function supplyChainSupplier1s()
    {
        return $this->hasMany(\App\Models\SupplyChainSupplier::class, 'supplier_id');
    }
}
