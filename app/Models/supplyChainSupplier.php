<?php

namespace App\Models;

use App\Traits\Auditable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class supplyChainSupplier
 * @package App\Models
 * @version June 27, 2021, 4:01 am UTC
 *
 * @property \App\Models\Level $level
 * @property \App\Models\Supplier $parentSupplier
 * @property \App\Models\Supplier $supplier
 * @property \App\Models\SupplyChain $supplyChain
 * @property integer $supply_chain_id
 * @property integer $supplier_id
 * @property integer $parent_supplier_id
 * @property integer $level_id
 */
class supplyChainSupplier extends Model
{
    use Auditable;
    public $table = 'supply_chain_suppliers';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'supply_chain_id',
        'supplier_id',
        'parent_supplier_id',
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
        'supplier_id' => 'integer',
        'parent_supplier_id' => 'integer',
        'level' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'supply_chain_id' => 'required',
        'supplier_id' => 'required',
        'parent_supplier_id' => 'nullable',
        'level' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function parentSupplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class, 'parent_supplier_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function supplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class, 'supplier_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function supplyChain()
    {
        return $this->belongsTo(\App\Models\SupplyChain::class, 'supply_chain_id');
    }
}
