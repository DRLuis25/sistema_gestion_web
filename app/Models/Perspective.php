<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Perspective
 * @package App\Models
 * @version September 13, 2021, 12:25 am -05
 *
 * @property \App\Models\PerspectivesCompany $perspectiveCompany
 * @property \App\Models\Process $process
 * @property \Illuminate\Database\Eloquent\Collection $objectives
 * @property integer $process_id
 * @property integer $perspective_company_id
 * @property integer $orden
 */
class Perspective extends Model
{

    public $table = 'perspectives';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'process_id',
        'perspective_company_id',
        'orden'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'process_id' => 'integer',
        'perspective_company_id' => 'integer',
        'orden' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'process_id' => 'required',
        'perspective_company_id' => 'required',
        'orden' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function perspectiveCompany()
    {
        return $this->belongsTo(\App\Models\perspectiveCompany::class, 'perspective_company_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function process()
    {
        return $this->belongsTo(\App\Models\Process::class, 'process_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function objectives()
    {
        return $this->hasMany(\App\Models\Objective::class, 'perspective_id');
    }
}
