<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class historial
 * @package App\Models
 * @version June 30, 2021, 4:43 am UTC
 *
 * @property \App\Models\SupplyChain $supplyChain
 * @property integer $supply_chain_id
 * @property string $description
 * @property string $data
 */
class historial extends Model
{
    use SoftDeletes;

    public $table = 'historial';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'supply_chain_id',
        'description',
        'data'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'supply_chain_id' => 'integer',
        'description' => 'string',
        'data' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'supply_chain_id' => 'required',
        'description' => 'nullable|string|max:80',
        'data' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function supplyChain()
    {
        return $this->belongsTo(\App\Models\SupplyChain::class, 'supply_chain_id');
    }
}
